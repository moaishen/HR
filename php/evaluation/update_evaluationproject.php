<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$epid=$_POST['epid'];
$epname=$_POST['epname'];

$results = $con->query("UPDATE evaluationprojects SET ProjectName='$epname' WHERE EP_ID=$epid");

if($results){
    print '考核已更新。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=evaluation_query.php\">";
}else{
  //  print 'Error : ('. $con->errno .') '. $con->error;
    print '考核更新出错。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=evaluation_query.php\">";
} 


addfoot();

?>
