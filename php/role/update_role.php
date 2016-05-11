<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$rid=$_POST['roles'];
$name=$_POST['rolename'];
$a=array(0,0,0,0,0,0,0,0,0);
for($i=0;$i<=8;$i++){
 if(isset($_POST[$i])){
$a[$i]=1;
 }
}


$auth=array();
$auth[0]="Auth_Authority";
$auth[1]="Auth_Info";
$auth[2]="Auth_Job";
$auth[3]="Auth_Attendance";
$auth[4]="Auth_Training";
$auth[5]="Auth_Evaluation";
$auth[6]="Auth_RP";
$auth[7]="Auth_Role";
$auth[8]="Auth_Encrypt";

$update="UPDATE roles SET ";
$update=$update."RoleName='".$name."',";
for($i=0;$i<=8;$i++){
$update=$update.$auth[$i]."=".$a[$i];
if($i!=8)$update=$update.",";
}

$update=$update." WHERE RoleID=$rid";
//echo $update;
$results = $con->query($update);

if($results){
	 echo "修改成功，将返回。";
	 echo "<meta http-equiv=\"refresh\" content=\"3;url=role_edit.php\">";
}else{
//print 'Error : ('. $con->errno .') '. $con->error;
	echo "修改失败，将返回。";
echo "<meta http-equiv=\"refresh\" content=\"3;url=role_edit.php\">";
}
 	 
 
 

?>
