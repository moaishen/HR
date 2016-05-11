<?php
include 'phpcommon.php';

echo <<<HTMLSTR
<table border="0">
<tr>
<th>请输入原密码</th>
<td><input type="password" name="oldpsd" id="oldpsd" required="required"></td>
</tr>
<tr>
<th>请输入新密码</th>
<td><input type="password" name="newpsd" id="newpsd" required="required"></td>
</tr>
<tr>
<th>请再次输入新密码</th>
<td><input type="password" name="newpsd1" id="newpsd1" required="required"></td>
</tr>
<tr><td><button type="button"  id="submit_btn" onclick="submit()">保存更改</button></td></tr>
</table>


<div id="infoout"></div>

<script language="JavaScript">
 function submit(){
 	var oldpsd=document.getElementById("oldpsd").value;
 	var newpsd=document.getElementById("newpsd").value;
 	var newpsd1=document.getElementById("newpsd1").value;
 	if(oldpsd==""){document.getElementById("infoout").innerHTML="原密码不能为空。";return;}
 	if(newpsd==""){document.getElementById("infoout").innerHTML="新密码不能为空。";return;}
 	if(newpsd1==""){document.getElementById("infoout").innerHTML="请再次输入新密码。";return;}
 	if(newpsd!=newpsd1){document.getElementById("infoout").innerHTML="您两次输入的新密码不同，请再次确认。";return;}
	var shao = hex_sha1(oldpsd);
  var shan = hex_sha1(newpsd);
  var url="update_password.php";
	var args="oldpsd="+shao+"&newpsd="+shan;
	//alert(url);
	postajax("infoout",url,args);
 }
</script>
HTMLSTR;
echo<<<OSTR
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
echo <<<sha1
<script type="text/ecmascript" src="../js/sha1.js"></script>
sha1;

addfoot();

?>
