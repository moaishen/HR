<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
echo<<<OSTR
<script language="JavaScript">
 function query(){
 	var tid=document.getElementById("tid").value;
 	 var ttype=document.getElementById("ttype").value;
 	 var fromdate=document.getElementById("fromdate").value;
 	 var todate=document.getElementById("todate").value;
 	 var args="tid="+tid+"&ttype="+ttype+"&fromdate="+fromdate+"&todate="+todate;
	var url="get_training_query.php";
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
  var url="training_del.php?trainingid="+id;
  if(confirm('你确定删除吗?'))
 {
   alertajax(url);
 }
}
</script>
OSTR;

addPOSTAJAX();
addALERTAJAX();

echo<<<HTMLSTR
<form action="get_training_query.php" method="get">
<table border="0">
<tr>
<td>培训项目编号</td>
<td><input id="tid" name="tid" type="text"></td>
<td>培训类型</td>
<td><input id="ttype" name="ttype" type="text"></td>
</tr>
<tr>
<td>大概在</td>
<td><input type="date" id="fromdate" name="fromdate"></td>
<td>到</td>
<td><input type="date" id="todate" name="todate"></td>
<td>期间</td>
</tr>
</table>
<table><tr><td>
<button type="button"  id="submit_btn" onclick="query()">查询</button></td></tr></table>
</form>
<div id="infoout"><div>
HTMLSTR;


addfoot();

?>
