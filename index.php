<?php
include("php/phptools.php");  
/*echo <<<h
<object type="application/x-shockwave-flash" style="outline:none;" data="http://cdn.abowman.com/widgets/hamster/hamster.swf?" width="300" height="225"><param name="movie" value="http://cdn.abowman.com/widgets/hamster/hamster.swf?"></param><param name="AllowScriptAccess" value="always"></param><param name="wmode" value="opaque"></param></object>
h;*/
if(!isset($_SESSION['userid'])){
  echo "<meta http-equiv=\"refresh\" content=\"0;url=login.html\">";
  exit;
}

///////////////////////////////////////////////////////////////登录
function login(){
  $con;
getDatabaseConnect($con);
$sql="SELECT EmployeeName FROM `Employees` WHERE `EmployeeID`=".$_SESSION['userid'];
$result =$con->query($sql);
if(!$result){exit;}
$row = $result->fetch_array();
$login="<a id=\"userid\" href=\"javascript:user()\">$row[EmployeeName]</a>";
$login=$login.'<a href="javascript:logout()"><img src="images/logout.png"></a>';	
return $login;
}

$login=login();
$year=date("Y");
echo <<<HTMLSTR
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" >
<title>人事档案管理系统</title>

<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/nav.js" type="text/javascript"></script>
</head>
 
<body onscroll="floatNav()">
 <Iframe  id="navframe" src="nav.php" scrolling="yes" frameborder="0" ></Iframe> 
  <div id="container">
    <div class="header" id="header">
        <a href="index.php"><img id="backtohomepage" src="images/home.png"></a>
      <div id="afterlogin">
        $login
      </div>
    </div>
  
	<div id="showbox">			
		<div id="showboxtitle">
      > Welcome
		</div>

		<Iframe id="showframe" src="welcome.html" scrolling="no" frameborder="0" onload="javascript:SetCwinHeight()" >
		</Iframe>
    
  </div>
  


<div id="foot" class="footer">
     <p>Copyright©$year maxuewei.All Rights Reserved.</p>
     <p>Contact information: <a href="http://mail.126.com/" target="_blank">maxuewei1995@126.com</a>.</p>
     <p>本站仅供学习测试所用</p>
</div>
<!-- end .container --></div>
</body>
</html>
HTMLSTR;
?>