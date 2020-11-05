# ProcessEventCalendar

<p>events.php is the ProcessWire-template where the buttons are located.<br/>
monthview.php is the ajax-loaded file for the month-calendar<br/>
organizer.php is the ajax loaded file for the events-listing<br/>
cal.js is the javascript that handles the ajax requests and changes the classes and titles of whatever is active or "current"</p>

<p>If you're installing this on ProcessWire, you will need the following fields.</p>

<p>1 field type "date" named "date_start"<br/>
1 field type "date" named "date_end"</p>

<p>and the following templates.</p>

<p>1 template called "events" using the above events.php file<br/>
1 template called "event" with the above fields date_start and date_end (and whatever other details you would probably like to add, left them out here to simplify)</p>

<p>create some dummy events (with template "event"), add as children to "events" to test</p>

<p>This is my first time contributing code. It kind of works but it's far from perfect, so I appreciate all (kind) input :D</p>

you can have a demo here: http://foobar.roofaccess.org/events/
