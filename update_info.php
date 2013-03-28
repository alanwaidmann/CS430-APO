<?php
function print_form()
{
echo<<<END
<h1>Update Information</h1>

<p>Please make sure to update your Local Address and Littles each semester!</p>
<p>If you wish to change your password, please go <a href="http://apo.truman.edu/members_updatepw.php">here</a>.</p>
<form method="POST">
<p>
<b>Personal</b><br/>
<label for="firstname">First Name</label> 
<input type="text" name="firstname" value =""/>
<br/>

<label for="lastname">Last Name</label> 
<input type="text" name="lastname" value = ""/>
<br/>

<label for="birthday">Birthday</label>
<select name="bmonth" id="bmonth"> 
	<option value="$row[bmonth]">$bmonth</option> 
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
<select name="bday" id="bday"> 
    <option>$row[bday]</option>
	<option>01</option> 
	<option>02</option> 
	<option>03</option> 
	<option>04</option> 
	<option>05</option> 
	<option>06</option> 
	<option>07</option> 
	<option>08</option> 
	<option>09</option> 
	<option>10</option> 
	<option>11</option> 
	<option>12</option> 
	<option>13</option> 
	<option>14</option> 
	<option>15</option> 
	<option>16</option> 
	<option>17</option> 
	<option>18</option> 
	<option>19</option> 
	<option>20</option> 
	<option>21</option> 
	<option>22</option> 
	<option>23</option> 
	<option>24</option> 
	<option>25</option> 
	<option>26</option> 
	<option>27</option> 
	<option>28</option> 
	<option>29</option> 
	<option>30</option> 
	<option>31</option> 
</select> 
<input name="byear" type="text" style="width: 50px;" maxlength="4" value="$row[byear]"/>
<br/>

<b>APO</b><br/>
<label for="pledgesem">Pledge Semester</label>
<select name="pledgesem"> 
	<option value="$row[pledgesem]">$row[pledgesem]</option> 
	<option value="Fall">Fall</option> 
	<option value="Spring">Spring</option> 
</select>
END;
echo '<select name="pledge_year">';
$date = date('m-d-y');
$year = date('Y', $date);
for(int $i = 1900; $i<$year; $i++)
{	
	echo '<option value="$i">$i</option>'; 		
}
echo<<<END
</select>
<br/>

<label for="family_flower">Flower</label> 
<select name="family_flower">
	<option>$row[famflower]</option> 
	<option value="Pink Carnation">Pink Carnation</option> 
	<option value="Red Carnation">Red Carnation</option>
	<option value="Red Rose">Red Rose</option> 
	<option value="White Carnation">White Carnation</option> 
	<option value="White Rose">White Rose</option> 
	<option value="Yellow Rose">Yellow Rose</option> 
</select>
<br/>

<label for="status">Status</label> 
<select name="status">
	<option>$row[status]</option>
	<option value="Active">Active</option>
	<option value="Associate">Associate</option>
	<option value="Pledge">Pledge</option> 
	<option value="Alumni">Alumni</option> 
	<option value="Early Alum">Early Alum</option> 
	<option value="Exec">Executive</option>
	<option value="Advisor">Advisor</option> 
	<option value="Inactive">Inactive</option> 
</select>
<br/>

<label for="bigbro">Big Brothers</label>
<textarea name="bigbro">$row[bigbro]</textarea>
<br/>

<label for="lilbro">Little Brothers</label>
<textarea name="littlebro">$row[littlebro]</textarea>
<br/>

<b>School</b><br/>
<label name="major">Major</label>
<input type="text" name="major" value="$row[major]"/>
<br/>

<label for="minor">Minor</label> 
<input type="text" name="minor" value="$row[minor]"/>
<br/>

<label for="grad_month">Graduation Date</label>
<select name="grad_month"> 
	<option>$row[gradmonth]</option> 
	<option value="May">May</option> 
	<option value="August">August</option> 
	<option value="December">December</option> 
</select>
<select name="grad_year">
END;
for(int $i=0; $i<$year+4; $i++)
{
	echo '<option value="2012">2012</option>';
}
echo<<<END
</select>
<br/>

<label for="school_year">Year</label>
<select name="school_year">
	<option>$row[schoolyear]</option>
	<option>Freshman</option>
	<option>Sophomore</option>
	<option>Junior</option>
	<option>Senior</option>
	<option>Alumni</option>
	<option>Other</option>
</select>
<br/>

<b>Contact</b><br/>
<label for="email">Email</label>
<input type="text" name="email" value="$row[email]"/>
<br/>

<label for="phone">Phone</label> 
<input type="text" name="phone" value="$row[phone]"/>
<br/>

<label for="local">Local Address</label>
<input type="text" name="local_address" value="$row[localaddress]"/>
<br/>

<label for="perm">Permanent Address</label> 
<input type="text" name="homeaddress" value="$row[homeaddress]"/>
<br/>

<label for="perm"></label> 
<input type="text" name="citystatezip" value="$row[citystatezip]"/>
<br/>

<b>Hide Contact Info</b><br/>
Yes<input type="radio" name="hide_info" value="T" $selectedT/><br/>
No<input type="radio" name="hide_info" value="F" $selectedF/>
<br/>

<input type="hidden" name="update" value="1"/>
<p align='center'>
<input type="submit" value="Update" style="font-size: 50px; border: 1px solid #FFCB46;"/>
</p>
</form>
END;
}
function process_form()
{
	$stmt = $dbh->prepare("UPDATE 'Member' SET (firstname, lastname, email, phone, schoolyear, gradsem, gradyear,
	pledgesem, pledgeyear, flowerid, bigbro, littlebro, statusid, position, birthday, activesem, riskmanagement,
	hideinfo) VALUES (:name, :value)");
);
}


?>
