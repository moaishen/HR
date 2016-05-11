<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$sql="SELECT * FROM `Employees` WHERE `EmployeeID`=".$_SESSION['userid'];
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();
$sex="男";
if($row['Sex']=='f'){$sex="女";}
list($by,$bm,$bd)=explode('-',$row['BirthDay']);
date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海
$age=date('Y')-$by;
$degreename=getDegreeName($row['DegreeID']);
$departmentname=getDepartmentName($row['DepartmentID']);
$employeetype=getEmployeeTypeName($row['EmployeeTypeID']);
$htmlstr = <<<HTMLSTR
<form id="alertpostform" action="update_employee.php" method="post">
<table border="0">
<tr>
<td>姓名</td>
<td><input type="text" name="employeename" readonly="readonly" value=$row[EmployeeName]></td>
<td>员工编号</td>
<td><input type="text" name="employeeid" readonly="readonly" value=$row[EmployeeID]></td>
<td>性别</td>
<td><input type="hidden" name="sex" readonly="readonly" value=$row[Sex]>
<input type="text" name="sex1" readonly="readonly" value=$sex>
</td>
</tr>
<tr>
<td>电话</td>
<td><input type="text" name="employeetel" value=$row[Phone] required="required"></td>
<td>生日</td>
<td><input type="date" name="employeebirthday" value=$row[BirthDay]  required="required"></td>
<td>年龄</td>
<td><input type="text" name="employeeage" readonly="readonly" value=$age></td>
</tr>
<tr>
<td>学历</td>
<td><input type="hidden" name="degree" readonly="readonly" value=$row[DegreeID]>
<input type="text" name="degree1" readonly="readonly" value=$degreename>
</td>
<td>部门</td>
<td><input type="hidden" name="department" readonly="readonly"  value=$row[DepartmentID]>
<input type="text" name="department1" readonly="readonly"  value=$departmentname>
</td>
<td>职位</td>
<td><input type="text" name="employeetitle" readonly="readonly" value=$row[Title]></td>
<td>薪水</td>
<td><input type="text" name="employeesalary" readonly="readonly" value=$row[Salary]></td>
</tr>
<tr>
<td>入职日期</td>
<td><input type="text" name="employeehiredate" readonly="readonly" value=$row[HireDate]></td>
<td>类型</td>
<td><input type="hidden" name="employeetype" readonly="readonly" value=$row[EmployeeTypeID]>
<input type="text" name="employeetype1" readonly="readonly" value=$employeetype>
</td>
</tr>
</table>
<table><tr><td><button type="submit"  id="submit_btn" >保存更改</button></td></tr></table>
</form>

HTMLSTR;


echo $htmlstr;
}
addfoot();

?>
