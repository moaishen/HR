<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$did=$_GET['departid'];
$mid=$_POST['managerid'];

$sql="SELECT * FROM `employees` WHERE EmployeeID=$mid AND DepartmentID=$did";
$result =getResult($sql);
if(!$result){
	print '要更改的主管不在本部门内，无法更改。将返回上一页'; 
    echo "<meta http-equiv=\"refresh\" content=\"5;url=department_manage.php?departid=$did\">";
}else{

$results = $con->query("UPDATE Departments SET ManagerID =$mid WHERE DepartmentID=$did");

if($results){
    echo "<meta http-equiv=\"refresh\" content=\"0;url=department_manage.php?departid=$did\">";
	exit;
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
    print '主管更改出错。将返回上一页'; 
    echo "<meta http-equiv=\"refresh\" content=\"5;url=department_manage.php?departid=$did\">";
} 
}
addfoot();

?>
