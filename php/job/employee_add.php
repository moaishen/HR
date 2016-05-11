<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海
$date=date("Y-m-d");
//echo $date;
$sex=getSelects("sex","sex",0,'m');
$degrees=getSelects("degree","degree",0,0);
$departments=getSelects("department","department",0,0);
$types=getSelects("employeetype","employeetype",0,0);
$htmlstr = <<<HTMLSTR
<form action="insert_employee.php" method="post">
<table border="0">
<tr>
<td>员工编号</td>
<td><input type="text" name="employeeid" required="required" ></td>
<td>姓名</td>
<td><input type="text" name="employeename" required="required"></td>
<td>性别</td>
<td>$sex</td>
</tr>
<tr>
<td>电话</td>
<td><input type="text" name="employeetel" required="required"></td>
<td>生日</td>
<td><input type="date" id="employeebirthday" name="employeebirthday" required="required" value=$date></td>
</tr>
<tr>
<td>学历</td>
<td>$degrees</td>
<td>部门</td>
<td>$departments</td>
<td>职位</td>
<td><input type="text" name="employeetitle" required="required" ></td>
<td>薪水</td>
<td><input type="text" name="employeesalary" required="required" ></td>
</tr>
<tr>
<td>入职日期</td>
<td><input type="date" id="employeehiredate" name="employeehiredate" required="required" value=$date></td>
<td>类型</td>
<td>$types</td>
</tr>
</table>
<table><tr><td><button type="submit"  id="submit_btn" >添加</button></td></tr></table>
</form>

HTMLSTR;


echo $htmlstr;
addfoot();

?>
