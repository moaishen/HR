<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$tid=$_POST['trainingid'];
$ttype=$_POST['trainingtype'];
$tbdate=$_POST['begindate'];
$tedate=$_POST['enddate'];
$tdesc=$_POST['description'];
$results = $con->query("UPDATE training SET BeginDate='$tbdate',EndDate='$tedate',TrainingType='$ttype',
	Description='$tdesc' WHERE TrainingID=$tid");

if($results){
    print '培训已更新。'; 
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
    print '培训更新出错。'; 
} 
echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>培训编号</th><th>起始日期</th><th>结束日期</th><th>培训类型</th><th>描述</th><th>参加人数</th>
<th colspan="2">操作</th>
</tr>
STR;
$sql="SELECT * FROM `training`  WHERE TrainingID=$tid";
//echo $sql;
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();
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
<td><a href="training_mod.php?trainingid=$row[TrainingID]">继续编辑</a></td>
<td><a href="training_query.php?">继续查询</a></td>
</tr>
OUT;
}

echo "</table>";

addfoot();

?>
