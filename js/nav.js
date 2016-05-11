function toPage(str){
var strarr=["个人信息","培训信息","奖惩信息","考核信息","考勤信息",
				"部门管理","设立部门",
				"查询员工","添加员工",
				"查询考勤",
				"添加培训","查询培训",
				"查询考核","添加考核",
				"查询奖励和惩罚","添加奖励或惩罚",
				"查询权限","权限管理",
				"查询角色","添加角色","删除角色","编辑角色",
				"修改密码"];
	var pagearr=["info/employee_info","info/training_info","info/rap_info","info/evaluation_info","info/attendance_info",
				"job/department_manage","job/department_add",
				"job/employee_query","job/employee_add",
				"attendance/attendance_query",
				"training/training_add","training/training_query",
				"evaluation/evaluation_query","evaluation/evaluation_add",
				"rap/rap_query","rap/rap_add",
				"authority/authority_query","authority/authority_manage",
				"role/role_query","role/role_add","role/role_del","role/role_edit",
				"password_mod"];
	var index=0;
	for (var i = strarr.length - 1; i >= 0; i--) {
		if(strarr[i]==str){index=i;break;}
	}
	var url="php/"+pagearr[index]+".php";
	var html="> <a onclick=\"changePage(this)\">"+str+"</a>";
	window.parent.document.getElementById("showboxtitle").innerHTML=html;
	window.parent.document.getElementById("showframe").src=url;
}
function changePage(obj){
var str=obj.innerHTML;
	toPage(str);	
}