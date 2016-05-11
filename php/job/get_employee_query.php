<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$id=$_GET['employeeid'];
$name=$_GET['name'];
$sex=$_GET['sex'];
$depart=$_GET['depart'];
$title=$_GET['title'];
$type=$_GET['type'];
$p=1;
if(isset($_GET['p'])){
	$p=$_GET['p'];
}
echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>编号</th><th>姓名</th><th>性别</th><th>生日</th><th>年龄</th><th>手机</th><th>学历</th>
<th>雇用日期</th><th>员工类型</th><th>部门</th><th>职位</th><th>薪水</th><th colspan="2">操作</th>
</tr>
STR;
$sql="SELECT * FROM `Employees` WHERE 1=1";
if($id!=""){$sql=$sql." AND EmployeeID='$id'";}
if($name!=""){$sql=$sql." AND EmployeeName like '%$name%'";}
if($sex!="nolimit"){$sql=$sql." AND Sex='$sex'";}
if($depart!="nolimit"){$sql=$sql." AND DepartmentID=".$depart;}
if($title!=""){$sql=$sql." AND Title like '%$title%'";}
if($type!="nolimit"){$sql=$sql." AND EmployeeTypeID=".$type;}
$bp=($p-1)*$page;
$sql=$sql." LIMIT $bp,$page";
//echo $sql;
$result =$con->query($sql);
if($result){
while($row = $result->fetch_array()){
$s="男";
if($row['Sex']=='f'){$s="女";}
list($by,$bm,$bd)=explode('-',$row['BirthDay']);
date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海
$age=date('Y')-$by;
$degreename=getDegreeName($row['DegreeID']);
$departmentname=getDepartmentName($row['DepartmentID']);
$employeetype=getEmployeeTypeName($row['EmployeeTypeID']);
//$delurl="employee_del.php?employeeid=".$row['EmployeeID'];
$eid=$row['EmployeeID'];
echo <<<OUT
<tr>
<td>$eid</td>
<td>$row[EmployeeName]</td>
<td>$s</td>
<td>$row[BirthDay]</td>
<td>$age</td>
<td>$row[Phone]</td>
<td>$degreename</td>
<td>$row[HireDate]</td>
<td>$employeetype</td>
<td>$departmentname</td>
<td>$row[Title]</td>
<td>$row[Salary]</td>
<td><a href="employee_mod.php?employeeid=$row[EmployeeID]">编辑</a></td>
<td><a onclick="delem($eid)">删除</a></td>
</tr>
OUT;
}
}
echo "</table>";

$sql="SELECT COUNT(*) AS cou FROM `Employees` WHERE 1=1";
if($id!=""){$sql=$sql." AND EmployeeID='$id'";}
if($name!=""){$sql=$sql." AND EmployeeName like'%$name%'";}
if($sex!="nolimit"){$sql=$sql." AND Sex='$sex'";}
if($depart!="nolimit"){$sql=$sql." AND DepartmentID=".$depart;}
if($title!=""){$sql=$sql." AND Title like '%$title%'";}
if($type!="nolimit"){$sql=$sql." AND EmployeeTypeID=".$type;}
$result =$con->query($sql);
$num=0;
if($result){
	$row = $result->fetch_array();
$num=$row['cou'];
}
addPageNum($num,$page,$p);
?>
