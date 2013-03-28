CS430-APO
-----------


Pages			  
-----------
create_event.php The create event form
[browse|event_list].php The event registration page
	sample: http://apo.truman.edu/service_dashboard.php
	sample: http://eventmanager.truman.edu/generallist.asp
manage.php The event manage page
	Appointed leaders can manage their own events
		leaders can record attendance after their events
	Creators can manage their events
		Creators can remove|add leaders
register.php The registration page
update_info.php The update information page
hours.php The page used to log hours


Rules			  
-----------

public	view events from the current day
public 	view events for future days
			through curent week
leader 	view their past events
leader	record attendance for their events
leader  cancel their events
Creator has ability to set-up next week

Def: current week - 
	The current week cycles Mon-Sun

Def: next week -
	The next week can be set-up Mon-Fri

Events get published to public on Fri