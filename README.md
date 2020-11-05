# ProcessEventCalendar

events.php is the ProcessWire-template where the buttons are located.
monthview.php is the ajax-loaded file for the month-calendar
organizer.php is the ajax loaded file for the events-listing
cal.js is the javascript that handles the ajax requests and changes the classes and titles of whatever is active or "current"

If you're installing this on ProcessWire, you will need the following fields…

1 field type "date" named "date_start"
1 field type "date" named "date_end"

and

1 template called "events" using the above events.php file
1 template called "event" with the above fields date_start and date_end (and whatever other details you would probably like to add, left them out here to simplify)

create some dummy events (with template "event"), add as children to "events" to test

This is my first time contributing code. It kind of works but it's far from perfect, so I appreciate all (kind) input :D

