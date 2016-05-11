<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
if(!isset($_GET['epid'])){
exit;
}
if(!isset($_GET['epname'])){
exit;
}
$epid=$_GET['epid'];
$epname=$_GET['epname'];

echo <<<OSTR
<script language="JavaScript">
function delem(id){
  //alert(id);
  var url="employeeevaluation_del.php?evid="+id+"&epid=$epid&epname=$epname";
  
  if(confirm('你确定删除吗?'))
 {
    window.location.href=url; 
 }
}
</script>
OSTR;

echo "<div class=\"title\">考核信息</div>";
echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>考核编号</th><th>考核名称</th>
</tr>
STR;
echo <<<OUT
<tr>
<td>$epid</td>
<td>$epname</td>
</tr>
OUT;
echo "</table>";


echo "<div class=\"title\">考核员工</div>";

echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>记录编号</th><th>员工编号</th><th>员工姓名</th><th>员工类型</th><th>所在部门</th>
<th>职位</th><th>日期</th><th>成绩</th><th colspan="2">操作</th>
</tr>
STR;
$res=getResult("SELECT EvaluationID,EmployeeID,EmployeeName,EmployeeTypeID,DepartmentID,Title,Date,Result 
  FROM `evaluations` NATURAL JOIN employees WHERE EvaluationProjectID=$epid");
while($row1 = $res->fetch_array()){
	$departname=getDepartmentName($row1['DepartmentID']);
	$typename=getEmployeeTypeName($row1['EmployeeTypeID']);
echo <<<OUT
<tr>
<td>$row1[EvaluationID]</td>
<td>$row1[EmployeeID]</td>
<td>$row1[EmployeeName]</td>
<td>$typename</td>
<td>$departname</td>
<td>$row1[Title]</td>
<td>$row1[Date]</td>
<td>$row1[Result]</td>
<td ><a href="employeeevaluation_mod.php?evid=$row1[EvaluationID]&epid=$epid&epname=$epname">编辑</a></td>
<td ><a onclick="delem($row1[EvaluationID])">删除</a></td>
</tr>
OUT;
}
echo "</table>";


echo "<div class=\"title\">添加员工考核记录</div>";
$date=date("Y-m-d");
echo<<<STR
<form action="insert_employeeevaluation.php" method="post">
<table border="0">
<td><input type="hidden" name="epid" value=$epid></td>
<td><input type="hidden" name="epname" value=$epname></td>
<tr>
<td>员工编号</td>
<td><input type="text" name="employeeid" required="required"></td>
</tr>
<tr>
<td>日期</td>
<td><input type="date" name="date" required="required" value=$date></td>
</tr>
<tr>
<td>成绩</td>
<td><input type="text" name="result" required="required"></td>
</tr>
<tr>
<td><button type="submit"  id="submit_btn" >添加</button></td>
</tr>
</tr>
</table>
</form>
STR;



addfoot();

?>
