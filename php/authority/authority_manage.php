<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
echo <<<OSTR
<script language="JavaScript">
function select(){
   var eid=document.getElementById("employeeidinput").value;
   var url="authority_manage.php?employeeid="+eid;
    window.location.href=url;
}
</script>
OSTR;
$eid=0;
if(!isset($_GET['employeeid'])){
 $result=getResult("SELECT EmployeeID from Employees Order BY EmployeeID LIMIT 1");
 if($result){
$row = $result->fetch_array();
$eid=$row['EmployeeID'];
}
}
else{
$eid=$_GET['employeeid'];
}
echo <<<INPUT
  <table><tr><td>员工编号</td><td><input type="text" id="employeeidinput" value=$eid></td>
INPUT;
echo <<<STR
<td><button type="button"  id="submit_btn" onclick="select()" >选择</button></td></tr></table>
STR;

echo "<div class=\"title\">员工信息</div>";
echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>员工编号</th><th>姓名</th><th>性别</th><th>学历</th>
<th>入职日期</th><th>员工类型</th><th>职位</th><th>薪资</th>
</tr>
STR;

$sql="SELECT EmployeeID,EmployeeName,Sex,DegreeID,HireDate,EmployeeTypeID,Title,Salary 
FROM `employees` WHERE EmployeeID=$eid";
 $result=getResult($sql);
 if($result){
while($row = $result->fetch_array()){
    $sex=getSex($row['Sex']);
    $degreename=getDegreeName($row['DegreeID']);
    $employeetype=getEmployeeTypeName($row['EmployeeTypeID']);
echo <<<OUT
<tr>
<td>$row[EmployeeID]</td>
<td>$row[EmployeeName]</td>
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

echo "<div class=\"title\">员工权限</div>";
echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>权限管理</th><th>信息管理</th><th>人事管理</th><th>考勤管理</th><th>培训管理</th><th>考核管理</th>
<th>奖惩管理</th><th>角色管理</th><th>加密管理</th>
</tr>
<tr>
STR;

$aarray=array(0,0,0,0,0,0,0,0,0);
$roles=array();
$sql="SELECT RoleID FROM `UserRole` WHERE `EmployeeID`=".$eid;
$result =$con->query($sql);
if($result){
while($row = $result->fetch_array()){
$roles[$row['RoleID']]=$row['RoleID'];
$sql1="SELECT * FROM `Roles` WHERE `RoleID`=".$row['RoleID'];
$result1 =$con->query($sql1);
$row1 = $result1->fetch_array();  
for($i=2;$i<=10;$i++){
if($row1[$i]==1){
  $aarray[$i-2]=1;
}
}
}
}
//print_r($aarray);

for($i=0;$i<=8;$i++){
 show($aarray[$i]);
}
echo "</tr></table>";

echo "<div class=\"title\">权限来源</div>";

echo <<<STR
<form name="input" action="update_userrole.php?employeeid=$eid" method="POST">
<table class="bordertable" border=1><tr>
<th>角色名称</th><th>权限管理</th><th>信息管理</th><th>人事管理</th><th>考勤管理</th><th>培训管理</th><th>考核管理</th>
<th>奖惩管理</th><th>角色管理</th><th>加密管理</th><th>操作</th>
</tr>
STR;
$result=getResult("SELECT * FROM Roles");
if($result){
while($row = $result->fetch_array()){  
echo "<tr>";
echo "<td>$row[RoleName]</td>";
show($row['Auth_Authority']);
show($row['Auth_Info']);
show($row['Auth_Job']);
show($row['Auth_Attendance']);
show($row['Auth_Training']);
show($row['Auth_Evaluation']);
show($row['Auth_RP']);
show($row['Auth_Role']);
show($row['Auth_Encrypt']);
if(inRole($row['RoleID'],$roles)==1){
echo "<td><input type=\"checkbox\" name=$row[RoleID] checked=\"checked\"></td>";
}
else{
 echo "<td><input type=\"checkbox\" name=$row[RoleID]></td>"; 
}
echo "</tr>";
}
}
echo "</table><table><tr><td><input type =\"submit\" class=\"submit\" value =\"提交\"></td></tr></table></form> ";

addfoot();


function show($auth){
if($auth==1){echo "<td style=\"color:green\">Y</td>";}
  else{echo "<td style=\"color:red\">N</td>";}
}
function inRole($r,$a){
foreach($a as $key=>$value){
  if($r==$key){return 1;
}
}
return 0;
}
?>
