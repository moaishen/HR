<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
echo <<<OSTR
<script language="JavaScript">
function select(){
   var rid=document.getElementById("roles").value;
   var url="role_del.php?rid="+rid;
    window.location.href=url;
}
</script>
OSTR;
$rid=-1;
if(isset($_GET['rid'])){
$rid=$_GET['rid'];
}
/*else{
   $result=getResult("SELECT RoleID from roles Order BY RoleID LIMIT 1");
$row = $result->fetch_array();
$rid=$row['RoleID'];
}*/
echo '<form name="input" action="delete_role.php" method="POST">';
echo "<table><tr><td>角色：</td>";
echo "<td><select id=\"roles\" name=\"roles\" onchange=\"select()\">";
   $result=getResult("SELECT RoleID,RoleName from roles Order BY RoleID");
if($result){
  while($row = $result->fetch_array()){   
  if($rid==-1){
$rid=$row['RoleID'];
}
  if($row['RoleID']!=$rid){echo "<option value=$row[RoleID]>$row[RoleName]</option>";}
    else{echo "<option value=$row[RoleID] selected=\"selected\">$row[RoleName]</option>";}
  }
}
echo "</select></td>";
echo <<<STR
<td><button type="button"  id="submit_btn" onclick="select()" >显示角色信息</button></td></tr></table>
STR;

echo '
<table class="bordertable" border="1">
<tr>
<th>角色名称</th><th>权限管理</th><th>信息管理</th><th>人事管理</th><th>考勤管理</th>
<th>培训管理</th><th>考核管理</th><th>奖惩管理</th><th>角色管理</th><th>加密管理</th>
</tr>
';
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

$result=getResult("SELECT RoleName,
Auth_Authority,Auth_Info,Auth_Job,Auth_Attendance,Auth_Training,Auth_Evaluation,Auth_RP,Auth_Role,Auth_Encrypt
 FROM roles WHERE RoleID =$rid");
if($result){
  $row = $result->fetch_array();
echo "<tr><td>$row[RoleName]</td>";
for($i=0;$i<=8;$i++){show($row[$auth[$i]]);}
echo "</tr>";
}
echo "</table>";
echo <<<STR
<table><tr><td><input type ="submit" class="submit" value ="删除"></button><td></tr></table></form>
STR;


addfoot();

function show($auth){
if($auth==1){echo "<td style=\"color:green\">Y</td>";}
  else{echo "<td style=\"color:red\">N</td>";}
}
?>
