<?php
include 'phptools.php';
$oldpsd=$_POST['oldpsd'];
$newpsd=$_POST['newpsd'];
$id=$_SESSION['userid'];
$sql="SELECT COUNT(*)as COU FROM `users` WHERE  EmployeeID='$id' AND Password='$oldpsd'";
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();	
if($row['COU']!=1){
echo '原密码错误';
exit;
}
}
else{
	echo '未知问题';
	exit;
}
$results = $con->query("UPDATE users SET Password='$newpsd' WHERE EmployeeID=$id");

if($results){
    print '更新成功';
}else{
    print '更新失败';
} 

$con->close();
?>