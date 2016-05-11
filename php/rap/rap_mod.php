<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$id=$_GET['rpid'];

$sql="SELECT * FROM `rewardsandpunishments` WHERE `RP_ID`=".$id;
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();
$rapselect=<<<OSTR
	<select id="raptype" name="raptype">
	<option value="r" >奖</option>;
	<option value="p" >惩</option>;
	</select>
OSTR;

echo<<<STR
<form action="update_rap.php" method="post">
<table  border="0">
<tr>
<td>奖惩记录编号</td>
<td><input type="text" name="rpid" readonly="readonly"  value=$row[RP_ID]></td>
<td>员工编号</td>
<td><input type="text" name="employeeid" readonly="readonly"  value=$row[EmployeeID]></td>
<td>奖惩类型</td>
<td>$rapselect</td>
<td>日期</td>
<td><input type="date" name="date" required="required" value=$row[Date]></td>
</tr>
</table>
<table  border="0">
<tr>
<td>原因</td>
<td>
<textarea rows="3" cols="100" name="reason" >$row[Reason]</textarea>
</td></tr>
</table>
<table  border="0">
<tr>
<td>备注</td>
<td>
<textarea rows="5" cols="100" name="remark" >$row[Remark]</textarea>
</td></tr>
<tr>
</table>
<table><tr><td><button type="submit"  id="submit_btn" >保存更改</button></td></tr></table>
</form>
STR;
}
addfoot();

?>
