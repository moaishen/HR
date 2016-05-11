<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海
$nowyear=date('Y');
$nowmonth=date('m');
$yearselect=getSelects("year","year",0,$nowyear);
$monthselect=getSelects("month","month",0,$nowmonth);
$outstr=<<<OSTR
<table>
<tr><td>
$yearselect
</td>
OSTR;
$outstr=$outstr.<<<OSTR
<td>$monthselect</td>
OSTR;
$outstr=$outstr.<<<OSTR
<td><button type="button"  id="submit_btn" onclick="select()" >查询</button></td></tr></table>
OSTR;
$outstr=$outstr.<<<OSTR
<div id="infoout"><div>
OSTR;
$outstr=$outstr.<<<OSTR
<script language="JavaScript">
 function select(){
 	 var year=document.getElementById("year").value;
 	 var month=document.getElementById("month").value;
	var url="get_attendance_info.php?y="+year+"&m="+month;
	//alert(url);
		ajax("infoout",url);
 }
</script>
OSTR;


echo $outstr;
addAJAX();
addfoot();

?>
