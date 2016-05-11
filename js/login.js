// JavaScript Document
//支持Enter键登录
document.onkeydown = function(e){
	if($(".bac").length==0)
	{
		if(!e) e = window.event;
		if((e.keyCode || e.which) == 13){
			var obtnLogin=document.getElementById("submit_btn")
			obtnLogin.focus();
		}
	}
}

$(function(){
	//提交表单
	$('#submit_btn').click(function(){
		show_loading();
		if($('#ID').val() == ''){
					
			show_err_msg('帐号未填写！');	
			$('#ID').focus();
		}else if($('#password').val() == ''){
				show_err_msg('密码未填写！');
				$('#password').focus();
			}else{
				//ajax提交表单，#login_form为表单的ID。 如：$('#login_form').ajaxSubmit(function(data) { ... });
				var IDa="",passworda="";
				IDa=$('#ID').val();
				passworda=$('#password').val();

				passworda = hex_sha1(passworda);

				/*var url="login.html";*/
			  $.post("/ajax/login.php",
				{
				ID:IDa,
				password:passworda
				},
				function(data,status){
				/*alert(IDa +"\n"+passworda);
				alert(data);*/
					if(data=="yes"){
					
	/*url="/index.php?userid="+IDa;*/
						show_msg('登录成功！  正在为您跳转...');
					/*$.post("index.php",
					{
					userid:IDa,
					});*/
				
						document.getElementById("form").submit();
						/**/

					}
					else{
						if(data=="wrongid"){
							show_err_msg('帐号不存在！');
							$('#ID').focus();
						}
						if(data=="wrongpassword"){
							show_err_msg('密码错误！');
							$('#password').focus();
						}
						if(data=="no"){
							show_err_msg('未知错误！');
							$('#ID').focus();
						}    
					}
				}
			 );
					
  
					
				}
			});
		}
);