<?php
include '../phptools.php';
checkAuth(dirname(__FILE__));
$id=$_GET['trainingid'];
//print $id; 
$results = $con->query("DELETE FROM training WHERE TrainingID=$id");

if($results){
    echo 1;
}else{
    echo 0;
} 

?>
