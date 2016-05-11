<?php
define('IN_SYS', TRUE);
$lifeTime = 1800; 
session_set_cookie_params($lifeTime); 
session_start();
$page=20;
$con;
getDatabaseConnect($con);
date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海
function checkAuth($filepath){
	if(!isset($_SESSION['userid'])){
  		//echo "<meta http-equiv=\"refresh\" content=\"0;url=/login.html\">";
  		echo "登录已过期，请重新登录。";
  		exit;
	}
	$path=explode('\\',$filepath); 
	$dir=end($path);
	$auth=array();
	$auth['authority']=1;
	$auth['info']=2;
	$auth['job']=3;
	$auth['attendance']=4;
	$auth['training']=5;
	$auth['evaluation']=6;
	$auth['rap']=7;
	$auth['role']=8;
	$auth['encrypt']=9;
	if(getAuth($auth[$dir])!=1){
		//echo "<meta http-equiv=\"refresh\" content=\"0;url=/index.php\">";
		echo "您没有访问该页面的权限";
		exit;
	}
}


function getDatabaseConnect(&$con){
$db_host="49.140.70.153:3306";                                           //连接的服务器地址
$db_user="employee";                                                  //连接数据库的用户名
$db_psw="helloworld";                                                  //连接数据库的密码
$db_name="employeemanage";                                           //连接的数据库名称
$con=new mysqli($db_host,$db_user,$db_psw,$db_name);
if (!$con)
 {
 die('Could not connect: ' . mysql_error());
 }
return $con;
}
function getSex($s){
	$sex="男";
if($s=='f'){$sex="女";}
return $sex;
}
function getDegreeName($degreeid){
	$con;
	getDatabaseConnect($con);
$sql="SELECT * FROM `Degrees` WHERE `DegreeID`=".$degreeid;
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();	
return $row['DegreeName'];
}
return "";
}

function getDepartmentName($departmentid){
	$con;
	getDatabaseConnect($con);
$sql="SELECT * FROM `Departments` WHERE `DepartmentID`=".$departmentid;
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();	
return $row['DepartmentName'];
}
return "";
}
function getEmployeeTypeName($typeid){
	$con;
	getDatabaseConnect($con);
$sql="SELECT * FROM `EmployeeType` WHERE `EmployeeTypeID`=".$typeid;
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();	
return $row['EmployeeTypeName'];
}
return "";
}
function getAttendanceStatusName($StatusID){
	$con;
	getDatabaseConnect($con);
$sql="SELECT * FROM `AttendanceStatus` WHERE `StatusID`=".$StatusID;
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();	
return $row['Status'];
}
return "";
}
function getEvaluationProjectName($EP_ID){
	$con;
	getDatabaseConnect($con);
$sql="SELECT * FROM `EvaluationProjects` WHERE `EP_ID`=".$EP_ID;
$result =$con->query($sql);
if($result){
	$row = $result->fetch_array();	
return $row['ProjectName'];
}
return "";
}
function getTrainingRow($trainingid){
	$con;
	getDatabaseConnect($con);
	$sql="SELECT * FROM `Training` WHERE `TrainingID`=".$trainingid;
	$result =$con->query($sql);
	if($result){
		$row = $result->fetch_array();	
	return $row;
	}
	return null;
}
/*
function getAuth($i){
	$con;
	getDatabaseConnect($con);
	$auth="";
	switch($i){
		case 1:	$auth="Auth_Authority";break;
		case 2:	$auth="Auth_Info";break;
		case 3:	$auth="Auth_Job";break;
		case 4:	$auth="Auth_Attendance";break;
		case 5:	$auth="Auth_Training";break;
		case 6:	$auth="Auth_Evaluation";break;
		case 7:	$auth="Auth_RP";break;
		case 8:	$auth="Auth_Role";break;
		case 9:	$auth="Auth_Encrypt";break;
	}
	if($auth=="")return 0;
	$sql="SELECT RoleID FROM `UserRole` WHERE `EmployeeID`=".$_SESSION['userid'];
	$result =$con->query($sql);
	if($result){
		while($row = $result->fetch_array()){
			$sql1="SELECT $auth FROM `Roles` WHERE `RoleID`=".$row['RoleID'];
			$result1 =$con->query($sql1);
			$row1 = $result1->fetch_array();	
			if($row1[$auth]==1)return 1;
		}
	}
	return 0;
}
*/

function getAuth($i){
	$con;
	getDatabaseConnect($con);
	$auth="";
	switch($i){
		case 1:	$auth="Auth_Authority";break;
		case 2:	$auth="Auth_Info";break;
		case 3:	$auth="Auth_Job";break;
		case 4:	$auth="Auth_Attendance";break;
		case 5:	$auth="Auth_Training";break;
		case 6:	$auth="Auth_Evaluation";break;
		case 7:	$auth="Auth_RP";break;
		case 8:	$auth="Auth_Role";break;
		case 9:	$auth="Auth_Encrypt";break;
	}
	if($auth=="")return 0;
	$sql="SELECT sum($auth) as sum FROM `UserRole` natural join `Roles` 
	WHERE `EmployeeID`= $_SESSION[userid] GROUP BY  `EmployeeID`";
	$result =$con->query($sql);
	if($result){
		$row = $result->fetch_array();
		if($row['sum']>=1)return 1;
	}
	return 0;
}

function getResult($sql){
	$con;
	getDatabaseConnect($con);
	$result =$con->query($sql);
	return $result;
}
function getSelects($s,$id,$nolimit,$select){
$htmlstr =<<<OSTR
	<select id=$id name=$id onchange="select()">
OSTR;
if($nolimit==1){$htmlstr=$htmlstr."<option value=\"nolimit\">不限</option>";}
	
	if($s=="sex"){
if($select=="m"){
	$htmlstr=$htmlstr."<option value=\"m\" selected=\"selected\">男</option>";
$htmlstr=$htmlstr."<option value=\"f\">女</option>";
}
if($select=="f"){
	$htmlstr=$htmlstr."<option value=\"m\">男</option>";
	$htmlstr=$htmlstr."<option value=\"f\" selected=\"selected\">女</option>";
	}
	if($select=="nolimit"){
	$htmlstr=$htmlstr."<option value=\"m\">男</option>";
	$htmlstr=$htmlstr."<option value=\"f\">女</option>";	
	}
	}
	
	if($s=="month"){
for($i=1;$i<=12;$i++){
if($select==$i){
$htmlstr=$htmlstr.<<<OSTR
<option value=$i selected="selected">$i</option>
OSTR;
}
else{
	$htmlstr=$htmlstr.<<<OSTR
<option value=$i>$i</option>
OSTR;
}
}
	}

	if($s=="year"){
		date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海
$nowyear=date('Y');
for($i=2013;$i<=$nowyear;$i++){
	if($select==$i){
$htmlstr=$htmlstr.<<<OSTR
<option value=$i selected="selected">$i</option>
OSTR;
}
else{
	$htmlstr=$htmlstr.<<<OSTR
<option value=$i>$i</option>
OSTR;
}

}
	}


if($s=="degree"){
$result=getResult("SELECT * FROM `Degrees` ORDER BY DegreeID");
if($result){
	while($row=$result->fetch_array()){
	if($select==$row['DegreeID']){
$htmlstr=$htmlstr.<<<OSTR
<option value=$row[DegreeID] selected="selected">$row[DegreeName]</option>
OSTR;
}
else{
$htmlstr=$htmlstr.<<<OSTR
<option value=$row[DegreeID]>$row[DegreeName]</option>
OSTR;
}
}
}
}

if($s=="department"){
$result=getResult("SELECT * FROM `Departments` ORDER BY DepartmentID");
if($result){
	while($row=$result->fetch_array()){
	if($select==$row['DepartmentID']){
$htmlstr=$htmlstr.<<<OSTR
<option value=$row[DepartmentID] selected="selected">$row[DepartmentName]</option>
OSTR;
}
else{
$htmlstr=$htmlstr.<<<OSTR
<option value=$row[DepartmentID]>$row[DepartmentName]</option>
OSTR;
}
}
}
}

if($s=="employeetype"){
$result=getResult("SELECT * FROM `EmployeeType` ORDER BY EmployeeTypeID");
if($result){
	while($row=$result->fetch_array()){
	if($select==$row['EmployeeTypeID']){
$htmlstr=$htmlstr.<<<OSTR
<option value=$row[EmployeeTypeID] selected="selected">$row[EmployeeTypeName]</option>
OSTR;
}
else{
$htmlstr=$htmlstr.<<<OSTR
<option value=$row[EmployeeTypeID]>$row[EmployeeTypeName]</option>
OSTR;
}
}
}
}

$htmlstr=$htmlstr."</select>";
return $htmlstr;
}

function addPageNum($num,$page,$p){
	if($num<=0){ return ;}
	$color="white";
	echo '<div id="pages">';
	//echo $num;
  $num=$num/$page;
$num=ceil($num);//取天棚
//echo $num;
//echo $p;
if($num<$p){$p=$num;}
if($p<=0){$p=1;}
if($num>1){
if($p==1){
echo "<span><a style=\"color:$color\" onclick=\"query(this)\">1</a></span>";
}
else{
echo '<span><a onclick="query(this)">1</a></span>';
}
}
if($p-4>2){
echo '···';
}
for($i=$p-4;$i<=$p+4;$i++){
  if($i>1&&$i<$num){
    if($p==$i){
    echo "<span><a style=\"color:$color\" onclick=\"query(this)\">$i</a></span>";  
    }else{
    echo "<span><a onclick=\"query(this)\">$i</a></span>";
    }
  }
}
if($p+4<$num-1){
echo '···';
}
if($p==$num){
echo "<span><a id=\"maxpagenum\" style=\"color:$color\" onclick=\"query(this)\">$num</a></span>";
}
else{
echo "<span><a id=\"maxpagenum\" onclick=\"query(this)\">$num</a></span>";
}

echo '<span>页码</span>';
echo '<input type="text" id="pagenum"><input type="button" value="转到" id="gotobutton" onclick="gotopage()">';

echo '</div>';
}
function addGoToPage(){
echo<<<HTMLSTR
<script language="JavaScript">
 function gotopage(){
 	var max=document.getElementById("maxpagenum").innerHTML;
 	var num=document.getElementById("pagenum").value;
 	if(!(/^-?\d+$/.test(num)))
    {num=1;}
	num=parseInt(num);
	max=parseInt(max);
 	if(num>max){num=max;}
 	if(num<1){num=1;}
 	getpage(num);
 }
 </script>
HTMLSTR;
}
?>