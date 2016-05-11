<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$id=$_POST['departmentid'];
//print $id; 
$results = $con->query("DELETE FROM departments WHERE DepartmentID=$id");

if($results){
    print '部门已取缔。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=department_manage.php\">";
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
    print '部门删除出错。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=department_manage.php\">";
} 

addfoot();
?>
