<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$year=$_GET['y'];
$month=$_GET['m'];
$type=$_GET['t'];
$eid=$_GET['e'];
$p=$_GET['p'];
echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>员工编号</th><th>姓名</th>
STR;
$sid=array();
$i=0;
$result=getResult("SELECT * FROM `attendancestatus` ORDER BY StatusID");
if($result){
while($row=$result->fetch_array()){
echo <<<OSTR
<th>$row[Status]</th>
OSTR;
$sid[$i]=$row['StatusID'];
$i++;
}
}
$sql="SELECT EmployeeID,EmployeeName,StatusID, count FROM
 (SELECT EmployeeID,StatusID,count(*)as count FROM `Attendances` WHERE 
YEAR(`Date`) =$year AND MONTH(Date)= $month GROUP BY EmployeeID,StatusID )
as CountAttendance NATURAL join employees ";
if($type!="nolimit"){$sql=$sql." where EmployeeTypeID=$type";}
if($eid!=""){$sql=$sql." where EmployeeID=$eid";}
$sql=$sql." ORDER BY EmployeeID,StatusID";

//echo $sql;
$result =$con->query($sql);
if(!$result){exit;}
$j=$i;
$name="";
$num=0;
$bp=($p-1)*$page;
//echo $bp;
$sum=0;
if($bp>0){
while($row = $result->fetch_array()){
	if($name!=$row['EmployeeName']){
		if($num==$bp){$num=0;break;}
		$num++;$sum++;
		$name=$row['EmployeeName'];
	}
}
}
while($row = $result->fetch_array()){
	if($name!=$row['EmployeeName']){
		$num++;$sum++;
		if($num==$page){break;}
		while($j<$i){$j++;echo "<td>0</td>";}
		$j=0;
		echo "</tr>";
		$name=$row['EmployeeName'];

echo <<<OUT
<tr>
<td>$row[EmployeeID]</td>
<td>$row[EmployeeName]</td>
OUT;
}
while($row['StatusID']!=$sid[$j]){$j++;echo "<td>0</td>";}
$j++;
echo "<td>$row[count]</td>";
}
while($j<$i){$j++;echo "<td>0</td>";}
while($row = $result->fetch_array()){
	if($name!=$row['EmployeeName']){
		$sum++;
		$name=$row['EmployeeName'];
	}
}


echo "</tr>";
echo "</table>";
//echo $sum;
addPageNum($sum,$page,$p);

?>
