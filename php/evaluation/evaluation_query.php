<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
echo <<<OSTR
<script language="JavaScript">
function delem(id){
	//alert(id);
	var url="evaluation_del.php?epid="+id;
	
	if(confirm('你确定删除吗?'))
 {
    window.location.href=url; 
 }
}
</script>
OSTR;

echo <<<STR
<table class="bordertable" border="1">
<tr>
<th>考核编号</th><th>考核项目名称</th><th>参加人数</th><th colspan="3">操作</th>
</tr>
STR;
$sql="SELECT * FROM `evaluationprojects`";
//echo $sql;
$result =$con->query($sql);
if($result){
	while($row = $result->fetch_array()){
$res=getResult("SELECT COUNT(*) AS cou FROM `evaluations` 
	WHERE EvaluationProjectID=$row[EP_ID]");
$row1 = $res->fetch_array();
echo <<<OUT
<tr>
<td>$row[EP_ID]</td>
<td>$row[ProjectName]</td>
<td>$row1[cou]</td>
<td><a href="evaluation_mod.php?epid=$row[EP_ID]">编辑</a></td>
<td><a href="employeeevaluation_edit.php?epid=$row[EP_ID]&epname=$row[ProjectName]">编辑员工考核</a></td>
OUT;
echo "<td><a onclick=\"delem($row[EP_ID])\">删除</a></td></tr>";
}
}

echo "</table>";
addfoot();

?>
