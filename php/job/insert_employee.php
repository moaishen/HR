<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$id=$_POST['employeeid'];
$name=$_POST['employeename'];
$tel=$_POST['employeetel'];
$sex=$_POST['sex'];
$birthday=$_POST['employeebirthday'];
$degree=$_POST['degree'];
$depart=$_POST['department'];
$title=$_POST['employeetitle'];
$salary=$_POST['employeesalary'];
$hiredate=$_POST['employeehiredate'];
$type=$_POST['employeetype'];

$results = $con->query("INSERT INTO Employees (EmployeeID,EmployeeName,Phone,Sex,
	BirthDay,DegreeID,DepartmentID,Title,
	Salary,HireDate,EmployeeTypeID)VALUES(
	$id,'$name','$tel','$sex','$birthday',$degree,$depart,'$title',$salary,'$hiredate',$type)
");
  
if($results){
    print '员工记录已添加。'; 
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
    print '员工记录添加出错。'; 
    exit;
} 


echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>员工编号</th><th>姓名</th><th>性别</th><th>生日</th><th>手机</th><th>学历</th>
<th>雇用日期</th><th>员工类型</th><th>部门</th><th>职位</th><th>薪水</th><th colspan="2">操作</th>
</tr>
STR;
$sql="SELECT * FROM `Employees` WHERE EmployeeID='$id'";
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();
$s="男";
if($row['Sex']=='f'){$s="女";}
$degreename=getDegreeName($row['DegreeID']);
$departmentname=getDepartmentName($row['DepartmentID']);
$employeetype=getEmployeeTypeName($row['EmployeeTypeID']);
echo <<<OUT
<tr>
<td>$row[EmployeeID]</td>
<td>$row[EmployeeName]</td>
<td>$s</td>
<td>$row[BirthDay]</td>
<td>$row[Phone]</td>
<td>$degreename</td>
<td>$row[HireDate]</td>
<td>$employeetype</td>
<td>$departmentname</td>
<td>$row[Title]</td>
<td>$row[Salary]</td>
<td><a href="employee_mod.php?employeeid=$row[EmployeeID]">编辑</a></td>
<td><a href="employee_del.php?employeeid=$row[EmployeeID]" onclick="confirm('你确定删除吗?')">删除</a></td>
</tr>
OUT;

}
echo "</table>";
addfoot();

?>
