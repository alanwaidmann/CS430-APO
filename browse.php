<?
require_once("utility_functions.inc.php");

$sql = "SELECT E.E_Id,E.Name,E.DOW,E.Description,E.EventType.Name,E.Location,
		E.publicNotes,E.privateNotes,O.startTime,O.endTime,O.Max,
		FROM Occurrence AS O, Event AS E, EventType
		WHERE O.E_Id=E.E_Id AND EventType.T_Id=E.Type";

$db = newPDO();
$stmt = $db->prepare($sql);
if($stmt->execute()){
	while($row=$stmt->fetch()){
		print_r($row);

		/* startTimeFriendly/endTimeFriendly calculations
		 * $startTimeFriendly=someFunc($startTime);
		 * $current calculation = require select from signed up table, 
		 * 		wherever that may be.
		 */
		echo"
		<li>
		<a style=\"text-decoration:none;border-bottom:1px dotted blue;margin-right:0px;\" class=\"alignright\">Show Info</a>
		<br/><strong>Date: </strong>{$date}<!-- calculated from startTime/endTime -->
												
		<a id=\"AUTO UNIQUE GEN ID\" href=\"javascript:FUNC TBD SHOW/HIDE;\" href=\"REGISTRATION LINK FOR EVENT\" style=\"text-decoration:none;border-bottom:1px dotted blue;margin-right:0px;\" class=\"alignright\">
		<font color=\"blue\">Sign Up</font></a>

		<br/><strong>Time: </strong>{$startTimeFriendly}&nbsp;
				- {$endTimeFriendly}&nbsp;
				<br/><strong>Location: </strong>{$Location}&nbsp;
				<br/><strong>Current: </strong>{$current}&nbsp;
				<br/><strong>Max: </strong>{$max}&nbsp;
				<div id=\"AUTO UNIQUE GEN ID\" style=\"display:none\"><strong>Description: </strong><p>{$Description}</p><br/>
				<strong>Notes: </strong>{$publicNotes}<br/>
				<strong>Project Leader: </strong>{$ProjectLeader}<br/>
				&nbsp;<strong>Email: </strong>{$projectLeaderEmail}
				&nbsp;<strong>Phone: </strong>{$projectLeaderPhone}
				</div> 
		</li>
		";









	}
}