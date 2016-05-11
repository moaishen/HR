<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$nowyear=date('Y');
$nowmonth=date('m');
echo "<table ><tr>";
echo "<td>".getSelects("year","year",0,$nowyear)."</td>";
echo "<td>".getSelects("month","month",0,$nowmonth)."</td>";
echo "<td>".getSelects("employeetype","employeetype",1,"nolimit")."</td>";
echo '<td>员工编号</td><td><input type="text" id="eid"></td>';
echo <<<OSTR
<td><button type="button"  id="submit_btn" onclick="select()" >查询</button></td></tr></table>
OSTR;
echo <<<OSTR
<div id="infoout"><div>
OSTR;
echo <<<OSTR
<script language="JavaScript">
 function select(){
 	query(1);
 }
function getpage(p){
var year=document.getElementById("year").value;
 	var month=document.getElementById("month").value;
 	var type=document.getElementById("employeetype").value;
	var eid=document.getElementById("eid").value;
	var url="get_attendance_query.php?y="+year+"&m="+month+"&t="+type+"&e="+eid+"&p="+p;
	ajax("infoout",url);
}
 function query(obj){
 	 var p=1;
 	 //alert(obj);	
 	 if(obj!=1){
 	 	p=obj.innerHTML;
 	 }
 	 getpage(p);
 }
</script>
OSTR;
addGoToPage();
addAJAX("GET");
addfoot();

?>
