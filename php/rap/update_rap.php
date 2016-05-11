<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$rpid=$_POST['rpid'];
$eid=$_POST['employeeid'];
$raptype=$_POST['raptype'];
$date=$_POST['date'];
$reason=$_POST['reason'];
$remark=$_POST['remark'];

$results = $con->query("UPDATE rewardsandpunishments SET Type='$raptype',Date='$date',Reason='$reason',
	Remark='$remark'
 WHERE RP_ID=$rpid");

if($results){
    print '奖惩记录已更新。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=3;url=\"rap_mod.php?rpid=$rpid\">";
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
    print '奖惩记录更新出错。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=3;url=\"rap_mod.php?rpid=$rpid\">";
} 


addfoot();

?>
