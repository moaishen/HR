<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$evid=$_GET['evid'];
$epid=$_GET['epid'];
$epname=$_GET['epname'];
$results = $con->query("DELETE FROM evaluations WHERE EvaluationID=$evid ");

if($results){
   print '考核记录已删除。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=employeeevaluation_edit.php?epid=$epid&epname=$epname\">";
}else{
  //print 'Error : ('. $con->errno .') '. $con->error;
   print '考核记录删除出错。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=employeeevaluation_edit.php?epid=$epid&epname=$epname\">";
} 
addfoot();
?>
