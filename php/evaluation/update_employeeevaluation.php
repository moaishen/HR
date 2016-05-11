<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$evid=$_POST['evid'];
$date=$_POST['date'];
$result=$_POST['result'];

$results = $con->query("UPDATE evaluations SET Date='$date',Result=$result WHERE EvaluationID=$evid");

if($results){
    print '考核记录已更新。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=3;url=\"employeeevaluation_mod.php?evid=$evid\">";
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
    print '考核记录更新出错。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=3;url=\"employeeevaluation_mod.php?evid=$evid\">";
} 


addfoot();

?>
