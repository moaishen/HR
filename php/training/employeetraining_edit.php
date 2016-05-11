<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$tid=$_GET['trainingid'];
echo "<div id=\"trainingemployees\">";

echo "<div class=\"title\">培训信息</div>";
echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>培训编号</th><th>起始日期</th><th>结束日期</th><th>培训类型</th><th>描述</th><th>参加人数</th>
</tr>
STR;
$sql="SELECT * FROM `training` WHERE TrainingID=$tid";
//echo $sql;
$result =$con->query($sql);
if($result){
  $row = $result->fetch_array();
$res=getResult("SELECT COUNT(*) as cou FROM `employeetraining` WHERE TrainingID=$row[TrainingID]");
$row1 = $res->fetch_array();
echo <<<OUT
<tr>
<td>$row[TrainingID]</td>

<td>$row[BeginDate]</td>

<td>$row[EndDate]</td>

<td>$row[TrainingType]</td>
<td>$row[Description]</td>
<td>$row1[cou]</td>
</tr>
OUT;
}
echo "</table>";


echo "<div class=\"title\">培训员工</div>";

echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>员工编号</th><th>员工姓名</th><th>员工类型</th><th>所在部门</th><th>职位</th><th>操作</th>
</tr>
STR;
$res=getResult("SELECT EmployeeID,EmployeeName,EmployeeTypeID,DepartmentID,Title
 FROM `employeetraining` NATURAL JOIN employees WHERE TrainingID=$tid");
if($res){
  while($row1 = $res->fetch_array()){
	$departname=getDepartmentName($row1['DepartmentID']);
	$typename=getEmployeeTypeName($row1['EmployeeTypeID']);
echo <<<OUT
<tr id=$row1[EmployeeID]>
<td>$row1[EmployeeID]</td>
<td>$row1[EmployeeName]</td>
<td>$typename</td>
<td>$departname</td>
<td>$row1[Title]</td>
<td ><a onclick="del($row1[EmployeeID],$tid)">删除</a></td>
</tr>
OUT;
}
}
//echo "<div id=\"out\"></div>";
echo "</table></div>";



//echo "<button type=\"button\" onclick=\"fresh()\">刷新</button>";
echo "<div class=\"title\">添加员工</div>";

echo<<<STR
<form action="insert_employeetraining.php" method="post">
<table border="0">
<tr>
<td><input type="hidden" name="trainingid" value=$tid></td>
<td>员工编号</td>
<td><input type="text" name="employeeid" required="required"></td>
<td><button type="submit"  id="submit_btn" >添加</button></td>
</tr>
</table>
</form>
STR;



echo <<<OSTR
<script language="JavaScript">

function fresh(){

	var url="get_employeetraining.php?tid="+$tid;

	ajax("trainingemployees",url);	
	//alert(url);
}

 function del(eid,tid){
  if(!confirm('你确定删除吗?'))
 {return ;}
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
    var res=xmlhttp.responseText;
   // document.getElementById("out").innerHTML=xmlhttp.responseText;
    if(res=="0"){alert("删除失败");}
    if(res=="1"){alert("删除成功");
//var parent=document.getElementById(eid).parentNode;
//var child=document.getElementById(eid);
//parent.removeChild(child);
    fresh();
}
    }
  }	
  var url="employeetraining_del.php?eid="+eid+"&tid="+tid;
 	//alert(url);
xmlhttp.open("GET",url,true);
xmlhttp.send();
 }
</script>
<Script language="JavaScript">window.onload=fresh();</script>
OSTR;

addAJAX();
addfoot();

?>
