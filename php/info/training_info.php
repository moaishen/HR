<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$sql="SELECT * FROM `EmployeeTraining` WHERE `EmployeeID`=".$_SESSION['userid'];
$result =$con->query($sql);
$outstr="";
if($result){
	while($rrow = $result->fetch_array()){
	$row=getTrainingRow($rrow['TrainingID']);
$str = <<<STR
<table border="0">
<tr>
<td>培训编号</td>
<td><input type="text" name="trainingid" readonly="readonly" value=$row[TrainingID]></td>
<td>培训类型</td>
<td><input type="text" name="trainingtype" readonly="readonly" value=$row[TrainingType]></td>
<td>开始日期</td>
<td><input type="text" name="begindate" readonly="readonly" value=$row[BeginDate]></td>
<td>结束日期</td>
<td><input type="text" name="enddate" readonly="readonly" value=$row[EndDate]></td>
</tr>
<tr>
</table>
<table border="0">
<td>培训描述</td>
<td><textarea rows="10" cols="100" name="description" readonly="readonly" >$row[Description]</textarea></td>
</tr>
</table>
<br>
<br>
STR;

$outstr=$outstr.$str;
}
}


echo $outstr;
addfoot();

?>
