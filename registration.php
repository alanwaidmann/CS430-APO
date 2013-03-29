<?php
function print_form() { 
#$db = newPDO();  
$db = 
echo <<<END
	<div class="content">
	
	
	<form method="POST"> 
<p> 
<b>Personal</b><br/> 
<label for="first_name">First Name</label> 
<input type="text" name="firstname" maxlenght="20" required/> 
<br/> 
 
<label for="last_name">Last Name</label> 
<input type="text" name="lastname" maxlength="20" required/> 
<br/> 
 
<label for="birthday">Birthday</label> <!--be sure to concatenate in YYYY-MM-DD format-->
<select name="bmonth" id="bmonth" required> 
	<option value="01">January</option> 
	<option value="02">February</option> 
	<option value="03">March</option> 
	<option value="04">April</option> 
	<option value="05">May</option> 
	<option value="06">June</option> 
	<option value="07">July</option> 
	<option value="08">August</option> 
	<option value="09">September</option> 
	<option value="10">October</option> 
	<option value="11">November</option> 
	<option value="12">December</option> 
</select> 
<select name="bday" id="bday" required> 
<?= $days=31?>
<script>
  var mon = document.forms["bmonth"].value;
  if(mon == "02"){
    <?= $days=29?>
  }
  if(mon == "04" || mon == "06" || mon == "09" || mon == "11"){
    <?= $days=30?>
  }
</script>
END;
for($i=1;$i<=$days;$i++){
  if($i<10){
    $p = "0".$i;
  } else {
    $p = $i;
  }
  echo "<option value=\"$p\">$i</option>"; 
};
echo <<<END
</select>
 
<select name="byear" id="byear" required>
END;
$year = date('Y');
for($i=-25; $i<-16; $i++){
  $year += $i;
  echo "<option value=\"$year\">$year</option>";
};
echo <<<END
</select> 
<br/> 
 
<b>APO</b><br/> 
<label for="pledgesem">Pledge Semester</label> 
<select name="pledgesem" required> 	
  <option value="Spring">Spring</option> 
	<option value="Fall">Fall</option> 
</select> 

<select name="pledgeyear" required>
END;

$year = date('Y');
for($i=-4; $i<4; $i++){
  $year += $i;
  echo "<option value=\"$year\">$year</option>";
};

echo <<<END


</select> 
<br/> 

<input type="hidden" name="status" value="0">
 
 
<b>School</b><br/> 
<label name="major">Major</label> 
<select name="major[]" multiple required> 
END;
#allows people to select multiple majors and stores it in an array to be passed to sql
$q = "SELECT * FROM `Major`";
$majors = $db->query($q) or die("Could not retrieve list of majors");
$m = $majors->fetchAll(PDO::FETCH_ASSOC);

for($k=0;$k<sizeof($m);$k++){
  $id = $m[$k]['Major_Id'];
  $name = $m[$K]['Name'];
  echo "<option value=\"$id\">$name</option>";
}
echo <<<END
</select> 
<br/> 

<label for="minor">Minor</label> 
<select name="minor[]" multiple required>
END;
#allows people to select multiple minors and stores it in an array to be passed to sql
$q = "SELECT * FROM `Minor`";
$minors = $db->query($q) or die ("Could not retrieve list of minors");
$mn = $minors->fetchAll(PDO::FETCH_ASSOC);

for($k=0;$k<sizeof($mn);$k++){
  $id = $mn[$k]['Major_Id'];
  $name = $mn[$K]['Name'];
  echo "<option value=\"$id\">$name</option>";
}
echo <<<END
</select>
<br/> 
 
<label for="gradsem">Graduation Date</label> 
<select name="gradsem" required> 
<option value="summer">Summer</option>
<option value="spring">Spring</option>
<option value="fall">Fall</option>
</select> 
<select name="gradyear" required>
END;
$year = date('Y');
for($i=0; $i<7; $i++){
  $year += $i;
  echo "<option value=\"$year\">$year</option>";
};

echo <<<END

</select> 
<br/> 
 
<label for="schoolyear">Year</label> 
<select name="schoolyear" required> 
	<option value="1">Freshman</option> 
	<option value="2">Sophomore</option> 
	<option value="3">Junior</option> 
	<option value="4">Senior</option> 
	<option value="5">Alumni</option> 
	<option value="6">Other</option> 
</select> 
<br/> 
 
<b>Contact</b><br/> 
<label for="email">Email</label> 
<input type="text" name="email" required/> 
<br/> 
 
<label for="ar">Phone</label> 
<input type="text" name="ar" maxlength="3" pattern=[\d]{3}/> 
  
<input type="text" name="phone3d" maxlength="3" pattern=[\d]{3}/>
 
<input type="text" name="phone4d" maxlength="4" pattern=[\d]{4}/>
<br/> 
 
<label for="local">Local Address</label> 
<input type="text" name="localaddress" maxlength="60" pattern="[\w,']*" required/> 
<br/> 
 
<label for="perm">Permanent Address</label> 
<input type="text" name="homeaddress" maxlength="60" pattern="[\w,']*" required/> 
<br/> 
 
<input type="text" name="citystatezip" maxlength="30" required/> 
<br/> 
END;
#creates array of usernames already in use
$uquery = "SELECT username FROM `Member`";
$r = $db->exec($uquery);

$usernames = $r->fetchAll();
echo <<<END
<b>Login</b><br/>
<label for="username">Username*</label>
<input type="text" name="username" maxlength="15" onblur="var chk = <?= json_encode($usernames) ?>;var name = document.forms[username].value;for(var i=0;i<chk.length;i++){if(chk[i] == name){alert("The username"+name+"has already been selected, please try another.");}}" required/>
<br/>

<label for="password">Password</label>
<input type="password" name="password" required/>
<br/>

<label for="regpass">Registration PW</label>
<input type="text" name="regpass" />
 
 
<input type="hidden" name="stage" value="process" />
  
 		<p align="center"><input type="submit" value="Register" /></p>
</form> 

END;

}

function process_form() {

	$firstname = $_POST['firstname']; 
  $lastname = $_POST['lastname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$bday = $_POST['byear']."-".$_POST['bmonth']."-".$_POST['bday'];
	
	#contact
	$homeaddress = $_POST['homeaddress'];
	$citystatezip = $_POST['citystatezip'];
	$localaddress = $_POST['localaddress'];
	$email = $_POST['email'];
	$phone = "(".$_POST['ar'].") ".$_POST['phone3d']."-".$_POST['phone4d']; 

  #school info
	$schoolyear = $_POST['schoolyear'];
	$major = $_POST['major'];
	$minor = $_POST['minor'];
	
	$gradsem = $_POST['gradsem'];
	$gradyear = $_POST['gradyear'];
	 
  $pledgesem = $_POST['pledgesem'];
	$pledgeyear = $_POST['pledgeyear'];
	
	$status = $_POST['status'];
	$regpass = $_POST['regpass'];
	#value of 1 means nothing as of now need to create new table to hold
	#auto_incrememted concurrent sems
	$active_semester = 1;



	$firstname = htmlspecialchars($firstname, ENT_QUOTES);
	$lastname = htmlspecialchars($lastname, ENT_QUOTES);
	$username = htmlspecialchars($username, ENT_QUOTES);
	$password = htmlspecialchars($password, ENT_QUOTES);
	$homeaddress = htmlspecialchars($homeaddress, ENT_QUOTES);
	$citystatezip = htmlspecialchars($citystatezip, ENT_QUOTES);
	$localaddress = htmlspecialchars($localaddress, ENT_QUOTES);
	$email = htmlspecialchars($email, ENT_QUOTES);
	$regpass = htmlspecialchars($regpass, ENT_QUOTES);



	if ($regpass == 'SpringRush2013') {

	  
		$insert = 
		  "INSERT INTO `Member` (
		  firstname, lastname, username, password, homeaddress, citystatezip, 
		  localaddress, email, phone, birthday, schoolyear, gradsem, 
		  gradyear, pledgesem, pledgeyear, Status_Id, active_sem) 
		  VALUES(
		  '$firstname','$lastname','$username', '$password', '$homeaddress', '$citystatezip', 
		  '$localaddress', '$email', '$phone','$bday', '$schoolyear', 
		  '$gradsem', '$gradyear', '$pledgesem', '$pledgeyear', 
		  '$status','$active_semester')";
		  
		$ex = $db->prepare($insert);
	  $ex->execute() or die("Some value in insert is invalid");
	  
	  #must create whole user before we can use their auto generated id to populate other tables
	  $db->beginTransaction();

	    
	  $id = "SELECT id FROM `member` WHERE username = '$username'";  
	  
	  #grabs all majors and minors that someone selected
		for($i=0;$i<sizeof($major);$i++){
		  $mjin = "INSERT INTO `MajorRoster` (M_Id,Major_Id) VALUES ('$id','$major[$i]')";
		  $db->exec($mjin);
		}
		for($i=0;$i<sizeof($minor);$i++){
		  $mnin = "INSERT INTO `MinorRoster` (M_Id,Minor_Id) VALUES ('$id','$minor[$i]')";
		  $db->exec($mjin);
		}
		
		$addin = 
		"INSERT INTO `Address`(M_Id, homeaddress, citystatezip, localaddress)
		VALUES('$id','$homeaddress','$citystatezip','$localaddress')";
		
		$ex1 = $db->prepare($addin);
		$ex1->execute();
		$db->commit();
		
		/*
		echo($query2);

		$query2 = mysql_query($insert) or die('<br/><div class="entry"><strong>Your username is already taken.  Please try again.</strong></div>');
*/



echo <<<END
		<div class="entry"><strong>Thank you for registering with APO-Epsilon!!!</strong></div>
END;

	} else {
		echo '<div class="entry"><strong>Your registration password was incorrect.  Please try again.<br />If you do not know your registration pass please contact the webmaster.</strong></div>';
		print_form();
	}
}

//if this is the first time viewing the page, print the form
//if not, process the form

//require_once ('layout.php');
//require_once ('mysql_access.php');
//page_header();

if (isset($_POST['stage']) && ('process' == $_POST['stage'])) { 
   process_form(); 
} else {
	print_form(); 
} 

echo "</div>";
//page_footer();
 ?>
