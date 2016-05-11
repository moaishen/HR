<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$year=$_GET['y'];
$month=$_GET['m'];
echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>日期</th><th>出勤情况</th>
</tr>
STR;
$con1;
getDatabaseConnect($con1);
$sql="SELECT * FROM `Attendances` WHERE `EmployeeID` = ".$_SESSION['userid'].
" AND YEAR(Date)= ".$year." AND MONTH(Date)= ".$month;
$result =$con1->query($sql);
if($result){
	while($row = $result->fetch_array()){
	$status=getAttendanceStatusName($row['StatusID']);
echo <<<STR1
<tr>
<td>$row[Date]</td><td>$status</td>
</tr>
STR1;
}
}
echo "</table>";
?>