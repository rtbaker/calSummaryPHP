# calSummary
Summarise an iCal calendar for display on a dot matrix display.

# Use
Configure the $calConfig array in the config.php file with a URL and a range for a unique key. The calendar events for that
range and calendar will be returned by http://server/calSummary.php?key=KEY.

The range specifies the events to return between now and now plus 'range' days.

MAKE SURE YOU DON'T PUT THE CONFIG FILE IN THE WEB SERVER DOCUMENTS DIRECTORY IF YOU
DON'T WANT PEOPLE TO SEE THE CONTENTS !

Example config file:

    <?php
    	$calConfig = array(
    		'dfrsf4fd' => array('url' => 'https://www.google.com/calendar/ical/123456%40group.calendar.google.com/private-1234546/basic.ics',
    										'range' => 30),
    		'sh4d3t' => array('url' => 'https://www.google.com/calendar/ical/123456%40group.calendar.google.com/private-123456/basic.ics',
    									'range' => 90),							
      );
    ?>

