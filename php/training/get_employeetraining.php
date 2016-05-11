<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$tid=$_GET['tid'];
echo "<div class=\"title\">培训信息</div>";
echo <<<STR
<table class="bordertable">
<tr>
<th>培训编号</th><th>起始日期</th><th>结束日期</th><th>培训类型</th><th>描述</th><th>参加人数</th>
</tr>
STR;
$sql="SELECT * FROM `training` WHERE TrainingID=$tid";
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
</tr>
OUT;
}
echo "</table>";


echo "<div class=\"title\">培训员工</div>";
echo <<<STR
<table class="bordertable">
<tr>
<th>员工编号</th><th>员工姓名</th><th>员工类型</th><th>所在部门</th><th>职位</th><th>操作</th>
</tr>
STR;
$res=getResult("SELECT EmployeeID,EmployeeName,EmployeeTypeID,DepartmentID,Title
 FROM `employeetraining` NATURAL JOIN employees WHERE TrainingID=$tid");
if($res){
	while($row1 = $res->fetch_array()){
	$departname=getDepartmentName($row1['DepartmentID']);
	$typename=getEmployeeTypeName($row1['EmployeeTypeID']);
echo <<<OUT
<tr id=$row1[EmployeeID]>
<td>$row1[EmployeeID]</td>
<td>$row1[EmployeeName]</td>
<td>$typename</td>
<td>$departname</td>
<td>$row1[Title]</td>
<td ><a onclick="del($row1[EmployeeID],$tid)">删除</a></td>
</tr>
OUT;
}
}
//echo "<div id=\"out\"></div>";
echo "</table>";

?>
