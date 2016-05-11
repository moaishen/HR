<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
echo "<div class=\"title\">添加角色</div>";


echo <<<STR
<form name="input" action="insert_role.php" method="POST">
<table class="bordertable" border=1><tr>
<th>角色名称</th><th>权限管理</th><th>信息管理</th><th>人事管理</th><th>考勤管理</th><th>培训管理</th><th>考核管理</th>
<th>奖惩管理</th><th>角色管理</th><th>加密管理</th>
</tr>
STR;

echo "<tr>";
echo <<<INPUT
<td><input type="text" id="rolenameinput" name="rolename" required="required"></td>
INPUT;
for($i=0;$i<=8;$i++){
echo "<td><input type=\"checkbox\" name=$i ></td>";
}
echo "</tr></table>";
echo "<table><tr>";
echo <<<STR
<td><input type ="submit" class="submit" value ="提交"></button><td></tr></table></form>
STR;


addfoot();

?>
