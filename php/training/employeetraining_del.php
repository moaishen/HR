<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$eid=$_GET['eid'];
$tid=$_GET['tid'];
//print $id; 
$results = $con->query("DELETE FROM employeetraining WHERE EmployeeID=$eid AND TrainingID=$tid ");

if($results){
   echo "1";
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
  echo "0";
} 

?>
