<?php
include("php/phptools.php"); 

if(!isset($_SESSION['userid'])){
  echo "<meta http-equiv=\"refresh\" content=\"0;url=login.html\">";
  exit;
}
//include("ajax/tools.php"); 


function info(){
  if(getAuth(2)==0)return "";
  $str = <<<HTMLSTR
  <div class="AccordionPanel">
 <div class="AccordionPanelTab">个人信息查询</div>
    <div class="AccordionPanelContent">
      <div onclick="changeTab(this)">个人信息</div>
      <div onclick="changeTab(this)">培训信息</div>
      <div onclick="changeTab(this)">奖惩信息</div>
      <div onclick="changeTab(this)">考核信息</div>
      <div onclick="changeTab(this)">考勤信息</div>
    </div>
  </div>
HTMLSTR;
return $str;
}

function job(){
  if(getAuth(3)==0)return "";
  $str = <<<HTMLSTR
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">部门管理</div>
    <div class="AccordionPanelContent">
    <div onclick="changeTab(this)">部门管理</div>
    <div onclick="changeTab(this)">设立部门</div>
    </div>
  </div>
<div class="AccordionPanel">
    <div class="AccordionPanelTab">员工管理</div>
    <div class="AccordionPanelContent">
    <div onclick="changeTab(this)">查询员工</div>
    <div onclick="changeTab(this)">添加员工</div>
    </div>
  </div>
HTMLSTR;
return $str;
}
function attendance(){
  if(getAuth(4)==0)return "";
  $str = <<<HTMLSTR
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">考勤管理</div>
    <div class="AccordionPanelContent">
    <div onclick="changeTab(this)">查询考勤</div>
    </div>
  </div>
HTMLSTR;
return $str;
}
function training(){
  if(getAuth(5)==0)return "";
  $str = <<<HTMLSTR
<div class="AccordionPanel">
    <div class="AccordionPanelTab">培训管理</div>
    <div class="AccordionPanelContent">
    <div onclick="changeTab(this)">添加培训</div>
    <div onclick="changeTab(this)">查询培训</div>
    </div>
  </div>
HTMLSTR;
return $str;
}
function evaluation(){
  if(getAuth(6)==0)return "";
  $str = <<<HTMLSTR

  <div class="AccordionPanel">
    <div class="AccordionPanelTab">考核管理</div>
    <div class="AccordionPanelContent">
    <div onclick="changeTab(this)">查询考核</div>
    <div onclick="changeTab(this)">添加考核</div>
    </div>
  </div>
HTMLSTR;
return $str;
}
function rap(){
  if(getAuth(7)==0)return "";
  $str = <<<HTMLSTR
<div class="AccordionPanel">
    <div class="AccordionPanelTab">奖惩管理</div>
    <div class="AccordionPanelContent">
      <div onclick="changeTab(this)">查询奖励和惩罚</div>
      <div onclick="changeTab(this)">添加奖励或惩罚</div>
    </div>
  </div>
HTMLSTR;
return $str;
}
function auth(){
  if(getAuth(1)==0)return "";
  $str = <<<HTMLSTR
<div class="AccordionPanel">
    <div class="AccordionPanelTab">权限管理</div>
    <div class="AccordionPanelContent">
        <div onclick="changeTab(this)">查询权限</div>
        <div onclick="changeTab(this)">权限管理</div>
    </div>
  </div>
HTMLSTR;
return $str;
}
function role(){
  if(getAuth(8)==0)return "";
  $str = <<<HTMLSTR
 <div class="AccordionPanel">
    <div class="AccordionPanelTab">角色管理</div>
    <div class="AccordionPanelContent">
        <div onclick="changeTab(this)">查询角色</div>
      <div onclick="changeTab(this)">添加角色</div>
      <div onclick="changeTab(this)">删除角色</div>
      <div onclick="changeTab(this)">编辑角色</div>
    </div>
  </div>
HTMLSTR;
return $str;
}



$info=info();
$job=job();
$attendance=attendance();
$training=training();
$evaluation=evaluation();
$rap=rap();
$auth=auth();
$role=role();


echo <<<HTMLSTR
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link href="./SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<script src="./SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<script src="js/nav.js" type="text/javascript"></script>
<script type="text/javascript">
function changeTab(obj){
	var content=obj.parentNode;//document.getElementById("Accordion1");
	//alert(elem);
	var panel=content.parentNode;
	var Accordion=panel.parentNode;
	var divs=Accordion.getElementsByTagName("div");
	for(var i=0; i<divs.length; i++)
        {
        	if(divs[i].className=="AccordionPanelContent"){
        		var nodes = divs[i].childNodes;//getElementsByTagName("div");
				 for(var j=0; j<nodes.length; j++)
       				 {
        				nodes[j].className="";
       				 }
        	}
        }
	obj.className="nav_on";
	var str=obj.innerHTML;
	///alert(str);
	toPage(str);	
}
</script>

<style type="text/css">
* {
	margin:0;
	padding:0;
	border:0px;
}
#navdiv {
	width:100%;
	text-align: center;
	vertical-align: middle;
	font:14px/16px "黑体";
}
#navdiv h3 {
	color:rgb(210,210,200);
}
#navdiv span {
	padding-top:20px;
	padding-bottom:20px;
	display: block;
}
</style>

</head>

<body>


HTMLSTR;


echo <<<HTML
<div id="navdiv">
<span><h3>人事档案管理系统</h3></span>
<div id="Accordion1" class="Accordion" >

$info
$job
$attendance
$training
$evaluation
$rap
$auth
$role
  
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">账户设置</div>
    <div class="AccordionPanelContent">
    	<div onclick="changeTab(this)">修改密码</div>
    </div>
</div>
</div>
<!-- end .navdiv --></div>
<script type="text/javascript">
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>

</body>
</html>
HTML;

	
?>