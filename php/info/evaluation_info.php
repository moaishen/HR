<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$sql="SELECT * FROM `Evaluations` WHERE `EmployeeID`=".$_SESSION['userid'];
$result =$con->query($sql);
$outstr="";
if($result){
	while($row = $result->fetch_array()){
$proname=getEvaluationProjectName($row['EvaluationProjectID']);
$str = <<<STR
<table border="0">
<tr>
<td>考核编号</td>
<td><input type="text" name="rapid" readonly="readonly" value=$row[EvaluationID]></td>
<td>考核项目编号</td>
<td><input type="text" name="date" readonly="readonly" value=$row[EvaluationProjectID]></td>
<td>考核项目</td>
<td><input type="text" name="raptype" readonly="readonly" value=$proname></td>
</tr>
<tr>
<td>日期</td>
<td><input type="text" name="date" readonly="readonly" value=$row[Date]></td>
<td>考核成绩</td>
<td><input type="text" name="date" readonly="readonly" value=$row[Result]></td>
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
