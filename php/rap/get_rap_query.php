<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$eid=$_POST['employeeid'];
$raptype=$_POST['raptype'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];

echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>奖惩记录编号</th><th>员工编号</th><th>奖惩类型</th><th>日期</th>
<th>原因</th><th>备注</th><th colspan="2">操作</th>
</tr>
STR;
$sql="SELECT * FROM `rewardsandpunishments`";
if($eid!=""){$sql="SELECT * FROM (".$sql.") AS any WHERE EmployeeID='$eid'";}
if($raptype!="nolimit"){$sql="SELECT * FROM (".$sql.") AS eid WHERE Type='$raptype'";}
if($fromdate!=""){$sql="SELECT * FROM (".$sql.")  AS type WHERE Date>='$fromdate'";}
if($todate!=""){$sql="SELECT * FROM (".$sql.")  AS fromdate WHERE Date<='$todate'";}
//echo $sql;
$result =$con->query($sql);
if($result){
	while($row = $result->fetch_array()){
	$type="奖";
	if($row['Type']=='p'){$type="惩";}
echo <<<OUT
<tr>
<td>$row[RP_ID]</td>
<td>$row[EmployeeID]</td>
<td>$type</td>
<td>$row[Date]</td>
<td>$row[Reason]</td>
<td>$row[Remark]</td>
<td><a href="rap_mod.php?rpid=$row[RP_ID]">编辑</a></td>
<td><a onclick="delem($row[RP_ID])">删除</a></td>
</tr>
OUT;
}
}
echo "</table>";



?>
