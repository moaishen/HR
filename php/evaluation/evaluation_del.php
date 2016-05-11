<?php
include '../phpcommon.php';
checkAuth(dirname(__FILE__));
$id=$_GET['epid'];
//print $id; 
$results = $con->query("DELETE FROM evaluationprojects WHERE EP_ID=$id");

if($results){
    print '考核已删除。将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=evaluation_query.php\">";
}else{
    //print 'Error : ('. $con->errno .') '. $con->error;
    print '考核删除出错。若考核仍有人员参加则不允许删除。即将返回。'; 
    echo "<meta http-equiv=\"refresh\" content=\"3;url=evaluation_query.php\">";
} 

addfoot();

?>
