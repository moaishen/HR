<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$tid=$_POST['tid'];
$ttype=$_POST['ttype'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];

echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>培训编号</th><th>起始日期</th><th>结束日期</th><th>培训类型</th><th>描述</th><th>参加人数</th>
<th colspan="3">操作</th>
</tr>
STR;

$sql="SELECT * FROM `training`";
if($tid!=""){$sql="SELECT * FROM (".$sql.") AS any WHERE TrainingID='$tid'";}
if($ttype!=""){$sql="SELECT * FROM (".$sql.") AS tid WHERE TrainingType like '%$ttype%'";}
if($fromdate!=""){$sql="SELECT * FROM (".$sql.")  AS type WHERE BeginDate>='$fromdate'";}
if($todate!=""){$sql="SELECT * FROM (".$sql.")  AS begindate WHERE EndDate<='$todate'";}
//echo $sql;
$result =$con->query($sql);
if($result){
	while($row = $result->fetch_array()){
$res=getResult("SELECT COUNT(*) as cou FROM `employeetraining` WHERE TrainingID=$row[TrainingID]");
$row1 = $res->fetch_array();
echo <<<OUT
<tr>
<td>$row[TrainingID]</td>
<td>$row[BeginDate]</td>
<td>$row[EndDate]</td>
<td>$row[TrainingType]</td>
<td>$row[Description]</td>
<td>$row1[cou]</td>
<td><a href="training_mod.php?trainingid=$row[TrainingID]">编辑</a></td>
<td><a href="employeetraining_edit.php?trainingid=$row[TrainingID]">编辑员工培训</a></td>
OUT;
echo "<td><a onclick=\"delem($row[TrainingID])\">删除</a></td></tr>";
}
}
echo "</table>";


?>
