<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$eid=$_GET['employeeid'];
$result=getResult("SELECT RoleID from roles Order BY RoleID");
if($result){
while($row = $result->fetch_array()){   
  $rid=$row['RoleID'];
   if(isset($_POST[$rid])){

   	$results = $con->query("INSERT INTO userrole (EmployeeID,RoleID)values($eid,$rid) ");
if($results){
}else{
}
 }
 else{
 	$results = $con->query("DELETE FROM userrole WHERE EmployeeID=$eid AND RoleID=$rid ");
 }
}
}
 //echo "<a href=\"authority_manage.php?employeeid=$eid\">返回</a>";
 echo "<meta http-equiv=\"refresh\" content=\"0;url=authority_manage.php?employeeid=$eid\">";
 
 

?>
