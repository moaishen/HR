<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
echo "<div class=\"title\">添加奖惩记录</div>";
//$date=Date('YmdHis');
//echo $date;
//exit;
$rapselect=<<<OSTR
	<select id="raptype" name="raptype">
	<option value="r" >奖</option>;
	<option value="p" >惩</option>;
	</select>
OSTR;
$date=Date('Y-m-d');
echo <<<STR
<form name="input" action="insert_rap.php" method="POST">
<table border=0>
<tr>
<th>员工编号</th>
<td><input type="text" id="employeeid" name="employeeid" required="required"></td>
<th>奖惩类型</th>
<td>$rapselect</td>
<th>日期</th>
<td><input type="date" name="date" required="required" value=$date></td>
</tr>
</table>
STR;


echo <<<INPUT
<table border=0>
<tr>
<td>原因</td>
<td><textarea rows="3" cols="100" name="reason" ></textarea></td>
</tr>
</table>
<table border=0>
<tr>
<td>备注</td>
<td><textarea rows="5" cols="100" name="remark" ></textarea></td>
</tr>
</table>
INPUT;
echo "<table><tr>";
echo <<<STR
<td><input type ="submit" class="submit" value ="提交"></button><td></tr></table></form>
STR;


addfoot();

?>
