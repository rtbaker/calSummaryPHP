<?php

use Sabre\VObject;
require_once 'vendor/autoload.php';

$calConfig = [
	'dfrsf4fd' => [ 'url' => 'https://www.google.com/calendar/ical/e5dtcl0a60cnlu00ma9mses6sk%40group.calendar.google.com/private-355f178d1421d1d12a94ce6173bde5ec/basic.ics',
									'range' => 30],
	'sh4d3t' => [ 'url' => 'https://www.google.com/calendar/ical/e5dtcl0a60cnlu00ma9mses6sk%40group.calendar.google.com/private-355f178d1421d1d12a94ce6173bde5ec/basic.ics',
														'range' => 90],							
];

$calURL = $calConfig['sh4d3t']['url'];
$range = $calConfig['sh4d3t']['range'];

// Get the calendar
$cal = VObject\Reader::read(fopen ($calURL, 'r'));

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

// Display as a single line of text 
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