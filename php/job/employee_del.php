<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$id=$_GET['employeeid'];
//print $id; 
$results = $con->query("DELETE FROM Employees WHERE EmployeeID=$id");

if($results){
    print '员工记录已删除。'; 
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
    print '员工记录删除出错。'; 
} 

echo <<<STR
<td><a href="employee_query.php">继续查询</a></td>
STR;
addfoot();

?>
