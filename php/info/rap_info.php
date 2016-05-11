<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$sql="SELECT * FROM `RewardsAndPunishments` WHERE `EmployeeID`=".$_SESSION['userid'];
$result =$con->query($sql);
$outstr="";
if($result){
	while($row = $result->fetch_array()){
	$type="奖励";if($row['Type']=='p')$type="惩罚";
$str = <<<STR
<table border="0">
<tr>
<td>奖惩编号</td>
<td><input type="text" name="rapid" readonly="readonly" value=$row[RP_ID]></td>
<td>奖惩类型</td>
<td><input type="text" name="raptype" readonly="readonly" value=$type></td>
<td>日期</td>
<td><input type="text" name="date" readonly="readonly" value=$row[Date]></td>
</tr>
<tr>
</table>

<table border="0">
<td>原因</td>
<td><textarea rows="2" cols="50" name="reason" readonly="readonly" value=>$row[Reason]</textarea></td>
</tr>
</table>
<table border="0">
<td>备注</td>
<td><textarea rows="5" cols="100" name="remark" readonly="readonly" value=>$row[Remark]</textarea></td>
</tr>
</table>
<br>
<br>
STR;

$outstr=$outstr.$str;
}
}


echo $outstr;
addfoot();

?>
