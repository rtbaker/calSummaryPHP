<?php

use Sabre\VObject;
require_once 'vendor/autoload.php';

// Get the config file, use @ so we don't leak any info
@include_once ('config.php');

if (!isset($calConfig)){
	print "No config file.\n";
	exit;
}

$calURL = $calConfig['sh4d3t']['url'];
$range = $calConfig['sh4d3t']['range'];

// Get the calendar
try {
	$cal = VObject\Reader::read(@fopen ($calURL, 'r'));
} catch (Exception $excep){
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
	$results[] = [ 'date' => $dtstart, 'event' => $event->SUMMARY ];
}

// Sort by date ascending
usort($results, "arraySort");

// Display as a single line of text' 
foreach ($results as $event){
	print "* ";
	print($event['date']->format('d/m/Y')) . " - ";
	print($event['event']) . " ";
}

print "*";


function arraySort($a, $b){
	return ($a['date']->getTimestamp() < $b['date']->getTimestamp()) ? -1 : 1;
}



?>