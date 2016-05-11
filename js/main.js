function logout(){
  if( confirm("你确实要退出吗？？")){
   //window.parent.location.href="index.php";
   window.parent.location.href="ajax/logout.php"; 	
  }
  else{
   return;
  }
 }


 function SetCwinHeight()
{
var cwin=document.getElementById("showframe");
if (document.getElementById)
{
if (cwin && !window.opera)
{
if (cwin.contentDocument && cwin.contentDocument.body.offsetHeight)
cwin.height = cwin.contentDocument.body.offsetHeight+200; 
else if(cwin.Document && cwin.Document.body.scrollHeight)
cwin.height = cwin.Document.body.scrollHeight;
}
}
}


function floatNav(){
	var t=document.getElementById("showboxtitle");
	var h=document.getElementById("header");
	//alert(f);
	if(t.getBoundingClientRect().top<0){
		t.className="floatdiv";
		//h.style.display="none";
	}
	if(h.getBoundingClientRect().top>=0){
		t.className="";
		//h.style.display="block";
	}
}

function user(){
	document.getElementById("showboxtitle").innerHTML="> <a onclick=\"changePage(this)\">修改密码</a>";
	document.getElementById("showframe").src="php/password_mod.php";
}

