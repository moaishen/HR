<?php
include 'phptools.php';
//$con;
//getDatabaseConnect($con);
$htmlstr = <<<HTMLSTR
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<style type="text/css">
*{font:14px/16px "宋体";margin:0px;padding:0px;}
a:link,a:visited{
  cursor: pointer;
color:white;
text-decoration:none;
}
a:hover{
  cursor: pointer;
color:white;
}
body
{
margin:50px 50px;
color:rgb(200,200,200);
}
.title{
  font:25px/28px "黑体";
  border-top: 1px solid rgb(180,180,180);
  text-align: center;
  margin-top: 25px;
  margin-bottom: 15px;
  padding:5px 0px;
 background-color: rgba(80,80,80,0.4);
  color: rgb(180,180,180);
}
form{
  margin:0 auto;
}
div{
  text-align: center;
}
input{  background-color:rgb(180,180,180);border:none;padding-left:5px;width:100%;padding-top:8px;padding-bottom:8px;}
textarea{  background-color:rgb(180,180,180);border:none;padding:5px;width:100%;}
select{  background-color:rgb(180,180,180);border:none;padding:8px;width:100%;}
button{  margin-left:5px;background-color:rgb(180,180,180);padding:4px 20px;border-radius:8px;border:2px solid rgb(190,190,190);width:100%;}
.submit{background-color:rgb(180,180,180);padding:4px 20px;border-radius:8px;border:2px solid rgb(190,190,190);width:100%;}
table
  {
    text-align:center;
    margin-top:20px;
  border-collapse:collapse;

 
  }
#infoout{
 margin-top:30px;
}
table{
   margin:0 auto;
   color:rgb(180,180,180);
}
table, td, th
  {
  padding:5px;
  border:none;
  }
.bordertable{  
  width:100%;
  color:black;
}
.bordertable th{
  font:16px/18px "宋体";
  font-weight:bold;
  padding-top:10px;
  padding-bottom:10px;
    background-color:rgb(180,180,180);
  border:1px solid RGB(120,120,120);
}
.bordertable td{
 background-color:rgb(200,200,200);
  border:1px solid RGB(120,120,120);
}
span{padding:5px;}
#pagenum{
padding-top:3px;padding-bottom:3px;
  font:10px/12px "Serif";width:20px;margin:3px;
}
#pages{font:10px/12px "Serif";}
#gotobutton{
padding-top:4px;padding-bottom:4px;
font:10px/12px "Serif";height:20px;width:35px;margin:3px;padding-right:5px;
}
</style>
</head>
<body>
HTMLSTR;


echo $htmlstr;


function addAJAX(){
	$outstr=<<<OSTR
<script language="JavaScript">
 function ajax(id,url){
 var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(id).innerHTML=xmlhttp.responseText;
    window.parent.SetCwinHeight();
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
 }
</script>
OSTR;
echo $outstr;
}

function addPOSTAJAX(){
  $outstr=<<<OSTR
<script language="JavaScript">
 function postajax(id,url,args){
 var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(id).innerHTML=xmlhttp.responseText;
    window.parent.SetCwinHeight();
    }
  }
xmlhttp.open("POST",url,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(args);
 }
</script>
OSTR;
echo $outstr;
}
function addALERTPOSTAJAX(){
  echo<<<OSTR
<script language="JavaScript">
 function alertpostajax(){
 var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(id).innerHTML=xmlhttp.responseText;
    window.parent.SetCwinHeight();
    }
  }
xmlhttp.open("POST",url,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(args);
 }
</script>
OSTR;
}

function addALERTAJAX(){
  $outstr=<<<OSTR
<script language="JavaScript">
 function alertajax(url){
 var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    { 
    if(xmlhttp.responseText==1){
      alert("成功");
    }
    if(xmlhttp.responseText==0){
      alert("失败。请重试。");
    }
    freshpage();
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
 }
</script>
OSTR;
echo $outstr;
}


function addfoot(){

	echo '</body>

    </html>';
}
?>