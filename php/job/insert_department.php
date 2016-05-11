<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$id=$_POST['departmentid'];
$name=$_POST['departmentname'];

$results = $con->query("INSERT INTO Departments (DepartmentID,DepartmentName)VALUES($id,'$name')");
  
if($results){
    print '部门已添加。'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=department_add.php\">";
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
    print '部门添加出错。将返回'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=department_add.php\">";
} 


addfoot();

?>
