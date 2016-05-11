<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$id=$_GET['trainingid'];

$sql="SELECT * FROM `training` WHERE `TrainingID`=".$id;
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();
echo<<<STR
<form action="update_training.php" method="post">
<table  border="0">
<tr>
<td>培训编号</td>
<td><input type="text" name="trainingid" readonly="readonly"  value=$row[TrainingID]></td>
<td>培训类型</td>
<td><input type="text" name="trainingtype" required="required"  value=$row[TrainingType]></td>
<td>开始日期</td>
<td><input type="date" name="begindate" required="required" value=$row[BeginDate]></td>
<td>结束日期</td>
<td><input type="date" name="enddate" required="required" value=$row[EndDate]></td>
</tr>
<tr>
</table>
<table border="0">
<td>培训描述</td>
<td><textarea rows="10" cols="100" name="description">$row[Description]</textarea></td>
</tr>
</table>
<table><tr><td><button type="submit"  id="submit_btn" >保存更改</button></td></tr></table>
</form>
STR;
}
addfoot();

?>
