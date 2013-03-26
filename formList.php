<?
function validateForm(){

// retrieve all post values
$eventName = $_POST['eventName'];
$eventDescription = $_POST['eventDescription'];
$eventDate = $_POST['eventDate'];
$type = $_POST['type'];
$fundraising = $_POST['fundraising'];
$eventLocation = $_POST['eventLocation'];
$publicNotes = $_POST['publicNotes'];
$privateNotes = $_POST['privateNotes'];
$recurring = $_POST['recurring'];
$DOW = $_POST['DOW'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$max = $_POST['max'];
$projectLeader = $_POST['projectLeader'];

// check to see if required items have values
if($eventName == NULL || $eventDescription == NULL || $eventDate == NULL || $eventLocation == NULL || $projectLeader == NULL || $max == NULL)
	{
	  echo '<div class="entry"><strong>All of the required fields were not filled out.  Please try again.</strong></div>';
	 // print_form();
	}

// if the event is recurring, additional information is required
if($recurring != NULL && ($DOW == NULL || $startTime == NULL || $endTime == NULL)){
	echo '<div class="entry"><strong>All of the required fields were not filled out.  Please try again.</strong></div>';
	// print_form();
}

// next steps are to range check some of the values and then insert them into the appropriate tables





}

function createEvent() {   
echo <<<END
	<div class="content">
	<form method="POST"> 
<p> 
<b>The "Create Event" Form</b><br/> 
<label for="eventName">Event Name</label> 
<input type="text" name="eventName"/>$eventName<br/>

<label for="eventDescription">Event Description</label><br/>
<textarea rows="3" cols="20" name="eventDescription"></textarea><br/>

<label for="eventDate">Event Date</label>
<input type="date" name="eventDate"/><br/>

<label for="type">Event Type</label>
<select name="type">
	<option value="">Community</option>
	<option value="">Chapter</option>
	<option value="">Campus</option>
	<option value="">Country</option>
	<option value="">Broho</option>
</select><br/>

<label for="fundraising">Fundraising?</label>
<input type="radio" name="fundraising" value="T">yes
<input type="radio" name="fundraising" value="F">no<br/>

<label for="Location">Location</label>
<input type="text" name="eventLocation"/><br/>

<label for="Notes">Public Notes</label><br/>
<textarea rows="3" cols="20" name="publicNotes"></textarea><br/>

<label for="Notes">Private Notes</label><br/>
<textarea rows="3" cols="20" name="privateNotes"></textarea><br/>

<label for="Recurring">Recurring?</label><br/>
<input type="radio" name="recurring" value="T">yes
<input type="radio" name="recurring" value="F">no<br/>

<label for="type">Event DOW</label>
<select name="DOW">
	<option value="Sun">Sunday</option>
	<option value="Mon">Monday</option>
	<option value="Tue">Tuesday</option>
	<option value="Wed">Wednesday</option>
	<option value="Thu">Thursday</option>
	<option value="Fri">Friday</option>
	<option value="Sat">Saturday</option>
</select><br/>

<!-- 
---- the following three should be for each shift 
---- also, shifts are any time slot for an event
---- on a given day 
-->

<label for="eventStartTime">Start Time: </label>
<input type="time" name="startTime"/><br/>

<label for="eventEndTime">End Time: </label>
<input type="time" name="endTime"/><br/>

<label for="maxEnrollment">Max Enrollment</label>
<input type="number" name="max" min="1" max="150"/><br/>

<label for="projectLeader">Project Leader</label>
<select name="projectLeader">
	<option value="theirName">Roster</option>
</select>
<input type="hidden" name="stage" value="verify" />
 	<p align="left"><input type="submit" value="Submit" /></p>
</form> 
END;

echo "<hr/>";
}


if(isset($_POST['stage'])){
	validateForm();
}else{
createEvent();
}























