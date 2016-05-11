<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海
$date=date("Y-m-d");
$htmlstr = <<<HTMLSTR
<form action="insert_training.php" method="post">
<table border="0">
<tr>
<td>培训编号</td>
<td><input type="text" name="trainingid" required="required"></td>
<td>起始日期</td>
<td><input type="date" id="begindate" name="begindate" required="required" value=$date></td>
<td>终止日期</td>
<td><input type="date" id="enddate" name="enddate" required="required" value=$date></td>
</tr>
</table>
<table>
<tr>
<td>培训类型</td>
<td><input type="text" name="trainingtype" required="required" ></td>
</tr>
</table>
<table>
<tr>
<td>描述</td>
<td><textarea rows="10" cols="100" name="trainingdesc" required="required" ></textarea></td>
</tr>
</table>

<table>
<tr><td>
<button type="submit"  id="submit_btn" >添加</button>
</tr></td>
</table>
</form>

HTMLSTR;


echo $htmlstr;
addfoot();

?>
