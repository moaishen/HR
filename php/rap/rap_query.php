<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
echo<<<OSTR
<script language="JavaScript">
 function query(){
 	var employeeid=document.getElementById("employeeid").value;
 	 var raptype=document.getElementById("raptype").value;
 	 var fromdate=document.getElementById("fromdate").value;
 	 var todate=document.getElementById("todate").value;
 	 var args="employeeid="+employeeid+"&raptype="+raptype+"&fromdate="+fromdate+"&todate="+todate;
	var url="get_rap_query.php";
	postajax("infoout",url,args);
 }
 function freshpage(){
 	query();
 }
</script>
OSTR;

echo <<<OSTR
<script language="JavaScript">
function delem(id){
  var url="rap_del.php?rpid="+id;
  if(confirm('你确定删除吗?'))
 {
   alertajax(url);

 }
}
</script>
OSTR;

addPOSTAJAX();
addALERTAJAX();
$rapselect=<<<OSTR
	<select id="raptype" name="raptype">
	<option value="nolimit" selected="selected">不限</option>
	<option value="r" >奖</option>;
	<option value="p" >惩</option>;
	</select>
OSTR;
//$date=date("Y-m-d");
echo<<<HTMLSTR
<form action="get_rap_query.php" method="get">
<table border="0">
<tr>
<td>员工编号</td>
<td><input id="employeeid" name="employeeid" type="text"></td>
<td>奖惩类型</td>
<td>$rapselect</td>
<td>从</td>
<td><input type="date" id="fromdate" name="fromdate"></td>
<td>到</td>
<td><input type="date" id="todate" name="todate"></td>
</tr>
</table>
<table><tr><td>
<button type="button"  id="submit_btn" onclick="query()">查询</button></td></tr></table>
</form>
<div id="infoout"><div>
HTMLSTR;


addfoot();

?>
