<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
//session_start();
//$con;
//getDatabaseConnect($con);

$tid=$_POST['trainingid'];
$eid=$_POST['employeeid'];
//echo $tid;
//echo $eid;
$results = $con->query("INSERT INTO employeetraining (TrainingID,EmployeeID)VALUES('$tid','$eid')");
  
if($results){
   // echo '1'; 
    echo "<meta http-equiv=\"refresh\" content=\"0;url=employeetraining_edit.php?trainingid=$tid\">";
  exit;
}else{
		echo "添加失败<a href=\"employeetraining_edit.php?trainingid=$tid\">返回</a>";
    //print 'Error : ('. $con->errno .') '. $con->error;
   // echo '0'; 
    exit;
} 
 

?>
