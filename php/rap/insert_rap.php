<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$eid=$_POST['employeeid'];
$date=$_POST['date'];
$raptype=$_POST['raptype'];
$reason=$_POST['reason'];
$remark=$_POST['remark'];


$in="INSERT INTO rewardsandpunishments (EmployeeID,Type,Date,Reason,Remark)
values('$eid','$raptype','$date','$reason','$remark')";
$results = $con->query($in);

if($results){
	print '奖惩记录添加成功。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=3;url=\"rap_add.php\">";
}else{
//print 'Error : ('. $con->errno .') '. $con->error;
	print '奖惩记录添加失败。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=3;url=\"rap_add.php\">";
}
 	 
 
 

?>
