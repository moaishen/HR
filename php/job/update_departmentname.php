<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$did=$_POST['departmentid'];
$name=$_POST['departmentname'];

$results = $con->query("UPDATE Departments SET DepartmentName='$name' WHERE DepartmentID='$did'");

if($results){
	 print '部门更名成功。将返回上一页'; 
    echo "<meta http-equiv=\"refresh\" content=3;url=\"department_manage.php?departid=$did\">";
	exit;
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
    print '部门更名失败。将返回上一页'; 
    echo "<meta http-equiv=\"refresh\" content=5;url=\"department_manage.php?departid=$did\">";
} 

addfoot();

?>
