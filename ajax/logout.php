<?php
session_start();
unset($_SESSION['userid']);
session_destroy();
$url="/login.html";
Header("HTTP/1.1 303 See Other"); 
Header("Location: $url"); 
exit; 
?>