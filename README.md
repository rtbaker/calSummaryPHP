# calSummary
Summarise an iCal calendar for display on a dot matrix display.

# Use
Configure the $calConfig array in the config.php file with a URL and a range for a unique key. The calendar events for that
range and calendar will be returned by http://server/calSummary.php?key=KEY.

The range specifies the events to return between now and now plus 'range' days.

Example config file:

<code>
	<?php

	$calConfig = [
		'dfrsf4fd' => [ 'url' =>
											'https://www.google.com/calendar/ical/123456%40group.calendar.google.com/private-1234546/basic.ics',
										'range' => 30],
		'sh4d3t' => [ 'url' =>
										'https://www.google.com/calendar/ical/123456%40group.calendar.google.com/private-123456/basic.ics',
															'range' => 90],							
	];


	?>
</code>
