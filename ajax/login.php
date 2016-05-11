<?php
include("../php/phptools.php"); 
$ID=$_POST['ID'];
$password=$_POST['password'];
$sql="SELECT * FROM `Users` WHERE `EmployeeID`=$ID";
$result =$con->query($sql);
if(!$result){echo "no";exit;}
$num=$result->num_rows;
if($num!=1){echo "wrongid";exit;}
$row = $result->fetch_array();
if($row['Password']!=$password){echo "wrongpassword";exit;}
$_SESSION['userid']=$ID;
echo "yes";
exit;
?>