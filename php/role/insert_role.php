<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
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

$in="INSERT INTO roles (";
	$in=$in."RoleName,";
 for($i=0;$i<=8;$i++){
 	$in=$in.$auth[$i];
 	if($i!=8)$in=$in.",";
 }
 	$in=$in.")values('$name',";
 for($i=0;$i<=8;$i++){
 	$in=$in.$a[$i];
 	if($i!=8)$in=$in.",";
 }	
 $in=$in.")";
$results = $con->query($in);

if($results){
	 echo "添加成功，请<a href=\"role_add.php\">返回</a>";
}else{
//print 'Error : ('. $con->errno .') '. $con->error;
	echo "添加失败，请<a href=\"role_add.php\">返回</a>";

}
 	 
 
 

?>
