<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$rpid=$_GET['rpid'];
$results = $con->query("DELETE FROM rewardsandpunishments WHERE RP_ID=$rpid ");

if($results){echo 1;
}else{
	echo 0;
}
?>
