<?php
include '../phpcommon.php';
echo<<<STR
<form action="insert_evaluationproject.php" method="post">
<table  border="0">
<tr>
<td>考核编号</td>
<td><input type="text" name="epid" ></td>
<td>考核项目名称</td>
<td><input type="text" name="epname"></td>
</tr>
<tr>
</table>
<table><tr><td><button type="submit"  id="submit_btn" >保存更改</button></td></tr></table>
</form>
STR;

addfoot();

?>
