<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$rid=$_POST['roles'];
$del="DELETE FROM roles WHERE RoleID=$rid";
$results = $con->query($del);

if($results){
	 echo "删除成功，将返回。";
	 echo "<meta http-equiv=\"refresh\" content=\"3;url=role_del.php\">";
}else{
//print 'Error : ('. $con->errno .') '. $con->error;
	echo "删除失败，将返回。";
echo "<meta http-equiv=\"refresh\" content=\"3;url=role_del.php\">";
}
 	 
 
 

?>
