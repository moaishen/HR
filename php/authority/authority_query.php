<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$aid=0;
if(isset($_GET['aid'])){
$aid=$_GET['aid'];
}
$auth=array();
$auth[0]="Auth_Authority";
$auth[1]="Auth_Info";
$auth[2]="Auth_Job";
$auth[3]="Auth_Attendance";
$auth[4]="Auth_Training";
$auth[5]="Auth_Evaluation";
$auth[6]="Auth_RP";
$auth[7]="Auth_Role";
$auth[8]="Auth_Encrypt";
echo "<table><tr><td>权限：</td>";
echo "<td><select id=\"auths\" name=\"auths\" onchange=\"select()\">";
for($i=0;$i<=8;$i++){
  if($i!=$aid){echo "<option value=$i>$auth[$i]</option>";}
    else{echo "<option value=$i selected=\"selected\">$auth[$i]</option>";}
  }
echo "</select></td>";
echo <<<STR
<td><button type="button"  id="submit_btn" onclick="select()" >选择</button></td></tr></table>
STR;
$roles=array();
$result=getResult("SELECT RoleID,RoleName from roles WHERE $auth[$aid]=1;");
if($result){
while($row = $result->fetch_array()){
  $roles[$row['RoleID']]=$row['RoleName'];
}
}
echo "<div class=\"title\">拥有该权限的员工</div>";
echo '
<table class="bordertable" border="1">
<tr>
<th>员工编号</th><th>姓名</th><th>部门</th><th>职位</th><th>员工类型</th><th>操作</th>
</tr>
';
$result=getResult("SELECT EmployeeID,EmployeeName,DepartmentID,Title,EmployeeTypeID FROM employees WHERE 
  EmployeeID IN (SELECT EmployeeID FROM userrole WHERE RoleID IN(SELECT RoleID from roles WHERE $auth[$aid]=1))");
if($result){
  while($row = $result->fetch_array()){
 // echo $row['EmployeeID'];
     $employeetype=getEmployeeTypeName($row['EmployeeTypeID']);
     $depart=getDepartmentName($row['DepartmentID']);
echo <<<OUT
<tr>
<td>$row[EmployeeID]</td>
<td>$row[EmployeeName]</td>
<td>$depart</td>
<td>$employeetype</td>
<td>$row[Title]</td>
<td><a style="color:blue" href="authority_manage.php?employeeid=$row[EmployeeID]">[权限管理]</a></td>
</tr>
OUT;
}
}
echo "</table>";

echo "<div class=\"title\">拥有该权限的角色</div>";
$authrole=0;if(getAuth(8)==1)$authrole=1;
echo '
<table class="bordertable" border="1">
<tr>
<th>角色编号</th><th>角色</th>';
if($authrole==1)echo"<th>操作</th>";
echo "</tr>";


foreach ($roles as $key => $value) {
  echo <<<OUT
<tr>
<td>$key</td>
<td>$value</td>
OUT;
if($authrole==1)echo '<td><a style="color:blue" href="../role/role_query.php?roleid=$key">[查看角色]</a></td>';
echo "</tr>";
}

addfoot();
echo <<<OSTR
<script language="JavaScript">
function select(){
	 var aid=document.getElementById("auths").value;
	 var url="authority_query.php?aid="+aid;
	  window.location.href=url;
}
</script>
OSTR;

addAJAX();


?>
