<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$epid=$_POST['epid'];
$epname=$_POST['epname'];

$results = $con->query("INSERT INTO evaluationprojects (EP_ID,ProjectName)VALUES($epid,'$epname')");
  
if($results){
    print '考核已添加。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=evaluation_add.php\">";
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
    print '考核添加出错。将返回'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=evaluation_add.php\">";
} 

addfoot();

?>
