<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
//session_start();
//$con;
//getDatabaseConnect($con);

$epid=$_POST['epid'];
$epname=$_POST['epname'];
$eid=$_POST['employeeid'];
$date=$_POST['date'];
$result=$_POST['result'];
$evid=$epid.$eid;
$results = $con->query("INSERT INTO evaluations (EvaluationID,EmployeeID,EvaluationProjectID,Date,Result)
	VALUES('$evid','$eid','$epid','$date','$result')");
  
if($results){
     print '考核记录已添加。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=employeeevaluation_edit.php?epid=$epid&epname=$epname\">";
}else{
	 // print 'Error : ('. $con->errno .') '. $con->error;
    print '考核记录添加出错。将返回'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=employeeevaluation_edit.php?epid=$epid&epname=$epname\">";
} 
 

?>
