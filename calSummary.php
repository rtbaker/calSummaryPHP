<?php

use Sabre\VObject;
require_once 'vendor/autoload.php';

// Get the config file, use @ so we don't leak any info
// WARNING !!! Make sure this config file is not in the web server documents directory, otherwise
// people will be able to see your calendar url's.
@include_once ('config.php');

if (!isset($calConfig)){
	header("HTTP/1.0 404 Not Found");
	print "No config file.\n";
	exit;
}

// Which one ?
if (!isset($_GET['token'])){
	header("HTTP/1.0 404 Not Found");
	print "token not set.\n";
	exit;
}

$token = $_GET['token'];

// Valid token ?
if (!isset($calConfig[$token]['url'])){
	header("HTTP/1.0 404 Not Found");
	print "Unknown token.\n";
	exit;
}

$calURL = $calConfig[$token]['url'];
$range = $calConfig[$token]['range'];

if (!isset($range)) { $range = 30; }

// Get the calendar
try {
	$cal = VObject\Reader::read(@fopen ($calURL, 'r'));
} catch (Exception $excep){
	header("HTTP/1.0 404 Not Found");
	print "Error opening calendar, check URL ?\n";
	exit;
}

// Expand any repeated events in the next 'range' days
$now = new DateTime();
$then = new DateTime();
$then->add(new DateInterval('P' . $range . 'D'));

$cal->expand($now, $then);

// Get the events
$events = $cal->VEVENT;

$results = array ();

foreach($cal->VEVENT as $event) {
	$dtstart = $event->DTSTART->getDateTime();
	array_push($results, array('date' => $dtstart, 'event' => $event->SUMMARY));
}

// Sort by date ascending
usort($results, "arraySort");

// Display as a single line of text' 
header("Content-Type: text/text");

foreach ($results as $event){
	print "* ";
	print($event['date']->format('d/m/Y')) . " - ";
	print($event['event']) . " ";
}


function arraySort($a, $b){
	return ($a['date']->getTimestamp() < $b['date']->getTimestamp()) ? -1 : 1;
}



?>