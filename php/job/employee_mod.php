<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$id=$_GET['employeeid'];

$sql="SELECT * FROM `Employees` WHERE `EmployeeID`=".$id;
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();
$sex=getSelects("sex","sex",0,$row['Sex']);
$degrees=getSelects("degree","degree",0,$row['DegreeID']);
$departments=getSelects("department","department",0,$row['DepartmentID']);
$types=getSelects("employeetype","employeetype",0,$row['EmployeeTypeID']);
$htmlstr = <<<HTMLSTR
<form action="update_employee.php" method="post">
<table border="0">
<tr>
<td>员工编号</td>
<td><input type="text" name="employeeid" readonly="readonly" value=$row[EmployeeID]></td>
<td>姓名</td>
<td><input type="text" name="employeename" required="required" value=$row[EmployeeName]></td>
<td>性别</td>
<td>$sex</td>
</tr>
<tr>
<td>电话</td>
<td><input type="text" name="employeetel" required="required" value=$row[Phone]></td>
<td>生日</td>
<td><input type="date" id="employeebirthday" name="employeebirthday" required="required"  value=$row[BirthDay]></td>
</tr>
<tr>
<td>学历</td>
<td>$degrees</td>
<td>部门</td>
<td>$departments</td>
<td>职位</td>
<td><input type="text" name="employeetitle" required="required"  value=$row[Title]></td>
<td>薪水</td>
<td><input type="text" name="employeesalary" required="required" value=$row[Salary]></td>
</tr>
<tr>
<td>入职日期</td>
<td><input type="date" id="employeehiredate" name="employeehiredate" required="required"  value=$row[HireDate]></td>
<td>类型</td>
<td>$types</td>
</tr>
</table><table><tr><td>
<button type="submit"  id="submit_btn" >保存更改</button></td></tr></table>
</form>

HTMLSTR;


echo $htmlstr;
}
addfoot();

?>
