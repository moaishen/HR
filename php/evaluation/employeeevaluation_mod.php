<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
if(!isset($_GET['evid'])){
exit;
}
$evid=$_GET['evid'];

echo "<div class=\"title\">更改员工考核记录</div>";

$res=getResult("SELECT * FROM `evaluations` WHERE EvaluationID=$evid");
$row = $res->fetch_array();
echo<<<STR
<form action="update_employeeevaluation.php" method="post">
<table border="0">
<tr>
<td>考核记录编号</td>
<td><input type="text" name="evid" value=$evid readonly="readonly"></td>
<td>员工编号</td>
<td><input type="text" name="employeeid" value=$row[EmployeeID] readonly="readonly"></td>
<td>考核项目编号</td>
<td><input type="text" name="epid" value=$row[EvaluationProjectID] readonly="readonly"></td>
</tr>
<tr>
<td>日期</td>
<td><input type="date" name="date" required="required" value=$row[Date]></td>
<td>成绩</td>
<td><input type="text" name="result" value=$row[Result]></td>
</tr>
<tr>
<td><button type="submit"  id="submit_btn" >更改</button></td>
</tr>
</tr>
</table>
</form>
STR;



addfoot();

?>
