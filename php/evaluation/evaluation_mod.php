<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$id=$_GET['epid'];

$sql="SELECT * FROM `evaluationprojects` WHERE `EP_ID`=".$id;
$result =$con->query($sql);
if($result){
$row = $result->fetch_array();
echo<<<STR
<form action="update_evaluationproject.php" method="post">
<table  border="0">
<tr>
<td>考核编号</td>
<td><input type="text" name="epid" readonly="readonly"  value=$row[EP_ID]></td>
<td>考核项目名称</td>
<td><input type="text" name="epname" value=$row[ProjectName]></td>
</tr>
<tr>
</table>
<table><tr><td><button type="submit"  id="submit_btn" >保存更改</button></td></tr></table>
</form>
STR;
}
addfoot();

?>
