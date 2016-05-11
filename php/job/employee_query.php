<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$sex=getSelects("sex","sex",1,"nolimit");
$departments=getSelects("department","department",1,"nolimit");
$types=getSelects("employeetype","type",1,"nolimit");
$htmlstr = <<<HTMLSTR
<form action="get_employee_query.php" method="get">
<table border="0">
<tr>
<td>员工编号</td>
<td><input id="employeeid" name="employeeid" type="text"></td>
<td>姓名</td>
<td><input id="employeename" name="employeename" type="text"></td>
<td>性别</td>
<td>$sex</td>
</tr>
<tr>
<td>部门</td>
<td>$departments</td>
<td>职位</td>
<td><input type="text" id="employeetitle" name="employeetitle"></td>
<td>员工类型</td>
<td>$types</td>
</tr>
</table>
<table><tr><td>
<button type="button"  id="submit_btn" onclick="query(1)">查询</button></td></tr></table>
</form>
<div id="infoout"><div>
HTMLSTR;
$htmlstr=$htmlstr.<<<OSTR
<script language="JavaScript">
 function ajax(id,url){
 var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(id).innerHTML=xmlhttp.responseText;
    window.parent.SetCwinHeight();
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
 }
 function getpage(a){
  var employeeid=document.getElementById("employeeid").value;
   var name=document.getElementById("employeename").value;
   var sex=document.getElementById("sex").value;
   var depart=document.getElementById("department").value;
   var title=document.getElementById("employeetitle").value;
   var type=document.getElementById("type").value; 
    var url="get_employee_query.php?employeeid="+employeeid+"&name="+name+"&sex="+sex+"&depart="+depart+"&title="+title+"&type="+type+"&p="+a;
  //alert(url);
    ajax("infoout",url);
 }
 function query(obj){
 	 var a=1;
 	 //alert(obj);	
 	 if(obj!=1){
 	 	a=obj.innerHTML;
 	 }
  getpage(a);
 }
</script>
OSTR;

echo $htmlstr;

echo <<<OSTR
<script language="JavaScript">
function delem(id){
	//alert(id);
	var url="employee_del.php?employeeid="+id;
	
	if(confirm('你确定删除吗?'))
 {
    window.location.href=url; 
 }
}
</script>
OSTR;
addGoToPage();
//addAJAX();
addfoot();

?>
