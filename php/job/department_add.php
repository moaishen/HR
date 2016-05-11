<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
echo<<<HTMLSTR
<form action="insert_department.php" method="post">
<table border="0">
<tr>
<td>部门编号</td>
<td><input type="text" name="departmentid" required="required" ></td>
<td>部门名称</td>
<td><input type="text" name="departmentname" required="required"></td>
</tr>
</table>
<table><tr><td><button type="submit"  id="submit_btn" >添加</button></td></tr></table>
</form>

HTMLSTR;


addfoot();

?>
