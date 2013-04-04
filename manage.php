<?php
function leader_form(){
$db = newPDO();
$qshift  = "SELECT E.Name, E.theDate, S.Start_time, S.End_time FROM Shift AS S JOIN Event AS E ON S.E_Id = E.E_Id ORDER BY E.Name DESC";
$qmember = "SELECT M.id, M.firstname, M.lastname FROM Member AS M ORDER BY M.lastname DESC";

$shift = $db->query($qshift) or die("Could not retrieve shifts.");
$mem   = $db->query($qmember) or die("Could not retrieve members");

$s = $shift->fetchAll(PDO::FETCH_ASSOC);
$m = $mem->fetchAll(PDO::FETCH_ASSOC);
echo <<<END
<form method="POST">
  <select name="pick_shift[]" multiple required>
END;

for($i=0;$i<sizeof($s);$i++){
  $s_id = $s[$i]['S_Id'];
  $d = date('D',$s[$i]['theDate']);
  $event = $s[$i]['Name']." ".$d." ".$s[$i]['Start_time']." ".$s[$i]['End_time'];
  echo "<option value=\"$s_id\">$event</option>";
}

echo <<<END
  </select>
  
  <select name="leader" required>
END;
  for($j=0;$j<sizeof($m);j++){
    $m_id = $m[$j]['M_Id'];
    $name = $m[$j]['lastname'].", ".$m[$j]['firstname']
    echo "<option value=\"$m_id\">$name<option>";
  }
echo <<<END
  </select>
  <input type="hidden" name="stage" value="process" />
</form>
END;
}

function process_form(){
  $sArr = $_POST['pick_shift[]'];
  $lead = $_POST['leader'];
  
  foreach($sArr as $indvs){
    $ins = "INSERT INTO `Leader` (M_Id,S_Id) VALUES ('$lead','$indvs')";
    $db->exec($ins) or die("Could not associate shift ".$indvs." with leader ".$lead);
  }
}
if (isset($_POST['stage']) && ('process' == $_POST['stage'])) { 
   process_form(); 
} else {
   leader_form(); 
} 
?>
