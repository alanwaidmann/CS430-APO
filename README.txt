CS430-APO
-----------

Scripts
-----------
Future week set-up of events.
	populate table using shift table
	allow for changes to occur
	VP can do so Mon-Fri. 
	Events roll out on Fri.
	?- What happens if VP does not do so? 
		The events should NOT roll out.
Attendance/Service Hours Logger
	Log hours once they have been approved
		onto recorded_hours table
	Log attendance once attendance has been confirmed
Force users to update information at beginning of semester
Prompts pledges to update their information after initiation
Change Pledge->Active after activation
	

DB
-----------
Intermediate table for Future week occurrences
Create table to hold default values
	ex: current semester
		next semester
		registration password
		service contract
		absences allowed
		date of initiation
		date of activation
		...
	The table should have a column to specify which 
		position can edit the default value.
	A column for the name of the value.
	A column for the value.
	A column for notes. (allow null).

Pages			  
-----------
create_event.php The create event form -- LM / JB / KT
[browse|event_list].php The event registration page -- LM
	sample: http://apo.truman.edu/service_dashboard.php
	sample: http://eventmanager.truman.edu/generallist.asp
	filter by type/service/broho/etc
manage.php The event manage page -- MH
	Appointed leaders can manage their own events
		leaders can record attendance after their events
	Creators can manage their events
		Creators can remove|add leaders
register.php The registration page -- AW
update_info.php The update information page -- BW
hours.php The page used to log hours
defaults.php The page where defaults can be changed
	(mentioned under DB)
	This dynamic page should display defaults that can be
		changed by the exec member that is viewing the page


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
