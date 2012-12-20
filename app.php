<?php 
@session_start();
define('fkpasswd', 'black_jesus');
if(isset($_GET["p"]) && $_GET["p"]=='exit'){
	header("Location: exit.php?k=$_GET[k]");
}

$_SESSION['data_real_login'] = md5(date('H').$_SESSION['ulo']);

foreach($_POST as $p => $v){
	$v = str_replace('%', '&#37;', $v);
	$v = str_replace('&', 'e', $v);
	$_POST[$p] = htmlentities($v, ENT_QUOTES, 'UTF-8');
	
}

foreach($_GET as $g => $v){
	$v = str_replace('%', '&#37;', $v);
	$v = str_replace('&', 'e', $v);
	$_GET[$g] = htmlentities($v, ENT_QUOTES, 'UTF-8');
}

mysql_select_db("", mysql_connect("", "", "")); //ommited for security

function generatorError($error, $page=''){
	$_SESSION["erro"] = $error;
	$_SESSION["website_data"] = $_POST;
	unset($_SESSION["sucess"]);
	if(!$page) $page='cadastre';
}
if(isset($_POST["clogin"], $_POST["password"], $_POST["cname"], $_POST["cpassword"]) && $_POST["clogin"]){
	if(strlen($_POST["clogin"])<5) generatorError("Login is very short!");
	if(strlen($_POST["password"])<8) generatorError("Password is very short!");
	if(strlen($_POST["cname"])<3) generatorError("Your name is very short! Are you a robot? :)");
	if(strcmp($_POST["password"], $_POST["cpassword"])) generatorError("You need to fill same passwords!");
	if(n(q("SELECT 1 FROM users WHERE UPPER(login) LIKE UPPER('$_POST[clogin]')"))) generatorError("This user already exists!");
	if(!isset($_SESSION["erro"])){
		q("INSERT INTO users(login, pw, name) values('$_POST[clogin]', '".md5(fkpasswd.$_POST["password"])."', '$_POST[cname]')");
		unset($_SESSION["website_data"]);
		$_SESSION["sucess"] = "Successfully register!";
	}
}

function q($q){
	return mysql_query($q);
}

function p($p){
	return mysql_fetch_array($p);
}

function n($n){
	return mysql_num_rows($n);
}

function login(){
	if(isset($_SESSION["ulo"]) && n(q("SELECT 1 FROM users WHERE id=".(int)$_SESSION['ulo']))) return true;
	return false;
}

function lb(){
	if(!login()) exit("<h1>Access deined!</h1> <a href='?p=home'>Efetuar login</a></div></body></html>");
}

if(isset($_POST["login"]) && isset($_POST["password"])){
	if($_POST["login"] && $_POST["password"]){
		$q = q("SELECT * FROM users WHERE UPPER(login) LIKE UPPER('$_POST[login]') AND PW='".md5(fkpasswd.$_POST["password"])."'");
		if(n($q)){
			$duser = p($q);
			unset($_SESSION["erro"]);
			$_SESSION["ulo"] =  $duser["id"];
			header("Location: ?p=video");
		}else $_SESSION["erro"] = "User or password isn't valid! Try again :)";
	}else{
		header("Location: index.php");
	}
}

?>
