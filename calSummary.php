<?php

use Sabre\VObject;
require_once 'vendor/autoload.php';

$calConfig = [
	'dfrsf4fd' => 'https://www.google.com/calendar/ical/e5dtcl0a60cnlu00ma9mses6sk%40group.calendar.google.com/private-355f178d1421d1d12a94ce6173bde5ec/basic.ics'
];

$cal = VObject\Reader::read(fopen ($calConfig['dfrsf4fd'], 'r'));

$events = $cal->VEVENT;
//var_dump ($events);

foreach($cal->VEVENT as $event) {
	print($event->SUMMARY) . "\n";
}






?>