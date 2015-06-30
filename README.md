# calSummary
Summarise an iCal calendar for display on a dot matrix display.

# Use
Configure the $calConfig array at the top with a URL and a range for a unique key. The calendar events for that
range and calendar will be returned by http://server/calSummary.php?key=XXXXXXXX.

The range specifies the events to return between now and now plus 'range' days.

