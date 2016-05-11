<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$p=1;
if(isset($_GET['p'])){
	$p=$_GET['p'];
}

echo "<table><tr><td>";
if(!isset($_GET['departid'])){
  echo getSelects("department","department",0,"0")."</td>";
}
else{
 echo getSelects("department","department",0,$_GET['departid'])."</td>"; 
}
echo <<<STR
<td><button type="button"  id="submit_btn" onclick="query(1)" >选择</button></td></tr></table>
STR;

echo "<div class=\"title\">部门信息</div>";
echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>部门编号</th><th>部门名称</th><th>主管编号</th><th>主管姓名</th><th>部门员工人数</th>
</tr>
STR;
$did=0;
$name="--";
$mid="--";
$result;
if(!isset($_GET['departid'])){
 $result=getResult("SELECT * from Departments Order BY DepartmentID LIMIT 1");
}
else{
$result=getResult("SELECT * from Departments WHERE DepartmentID=$_GET[departid];");
}
if(!$result){exit;}
	$row = $result->fetch_array();
$did=$row['DepartmentID'];
 $result=getResult("SELECT EmployeeName from Employees WHERE EmployeeID =$row[ManagerID]");
if($result){ $namerow = $result->fetch_array();$name=$namerow['EmployeeName'];$mid=$row['ManagerID'];}

 $result=getResult("SELECT COUNT(*) AS COU from Employees WHERE DepartmentID =$did");
 if($result){
 	$numrow = $result->fetch_array();
 }
echo <<<STR
<tr>
<td>$row[DepartmentID]</td><td>$row[DepartmentName]</td><td>$mid</td>
<td>$name</td><td>$numrow[COU]</td>
</tr>
STR;
echo '</table>';
$earray= array();
echo "<div class=\"title\">部门员工信息</div>";
if($numrow['COU']>0){
echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>员工编号</th><th>姓名</th><th>性别</th><th>学历</th>
<th>入职日期</th><th>员工类型</th><th>职位</th><th>薪资</th>
</tr>
STR;

$sql="SELECT EmployeeID,EmployeeName,Sex,DegreeID,HireDate,EmployeeTypeID,Title,Salary 
FROM `employees` WHERE DepartmentID=$did";
$bp=($p-1)*$page;
$sql=$sql." LIMIT $bp,$page";

//echo $sql;
$result =getResult($sql);
if($result){
while($row = $result->fetch_array()){
    $earray[$row['EmployeeID']]=$row['EmployeeName'];
    $sex=getSex($row['Sex']);
    $degreename=getDegreeName($row['DegreeID']);
    $employeetype=getEmployeeTypeName($row['EmployeeTypeID']);
echo <<<OUT
<tr>
<td>$row[EmployeeID]</td>

<td><a style="color:green" href="employee_mod.php?employeeid=$row[EmployeeID]">$row[EmployeeName]</a></td>

<td>$sex</td>

<td>$degreename</td>
<td>$row[HireDate]</td>
<td>$employeetype</td>
<td>$row[Title]</td>
<td>$row[Salary]</td>
</tr>
OUT;
}
}
echo "</table>";
addPageNum($numrow['COU'],$page,$p);
}
else{echo'<div>无</div>';}



if($numrow['COU']>0){
echo "<div class=\"title\">更改主管</div>";

echo <<<STR
<form name="input" action="update_departmentmanager.php?departid=$did" method="POST">
<table><tr>
STR;
$i=0;
 foreach($earray as $key=>$value){
  if($mid!=$key){
  echo "<td><input type=\"radio\" name=\"managerid\" value=$key >$value</td>";
}
else{
 echo "<td><input type=\"radio\" name=\"managerid\" value=$key checked=\"checked\">$value</td>";
}

$i++;
if($i==5){echo "</tr><tr>";$i=0;}
}
if(count($earray)>0)echo "</tr><td><input type =\"submit\" class=\"submit\" value =\"提交\"></td></table></form> ";
}
else{
echo "<div class=\"title\">取缔本部门?</div>";
echo <<<STR
<form name="input" action="department_del.php" method="POST">
<table><tr>
<td><input type="hidden" name="departmentid" value=$did ></td>
</tr>
</table>
STR;
echo "<table><tr><td><input type =\"submit\" class=\"submit\" value =\"取缔\"></td></tr></table></form> ";
}

echo "<div class=\"title\">部门更名</div>";
echo <<<STR
<form name="input" action="update_departmentname.php" method="POST">
<table><tr>
<td><input type="hidden" name="departmentid" value=$did ></td>
<td>部门新名称</td>
<td><input type="text" name="departmentname"></td>
</tr>
</table>
STR;
echo "<table><tr><td><input type =\"submit\" class=\"submit\" value =\"更名\"></td></tr></table></form> ";


echo <<<OSTR
<script language="JavaScript">
function select(){
	  query(1);
}
</script>
OSTR;
echo <<<OSTR
<script language="JavaScript">
 function getpage(a){
var did=document.getElementById("department").value;
	 var url="department_manage.php?departid="+did+"&p="+a;
	  window.location.href=url;
 	}
 function query(obj){
 	 var a=1;
 	 //alert(obj);	
 	 if(obj!=1){
 	 	//alert(2);
 	 	a=obj.innerHTML;
 	 }
	getpage(a);
 }
</script>
OSTR;
addGoToPage();
addfoot();

?>
