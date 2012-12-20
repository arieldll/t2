<?php
	include 'app.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Music Finder</title>
		<style type="text/css">
			body{
				font-family: arial, verdana;
				font-size: 12px;
				background-image: url('img/fundo.jpg');
				background-attachment: fixed;
			}
			.field{
				width: 920px;
				font-family: arial, verdana;
				font-size: 15px;
				height: 30px;
				border: 1px solid #AAA;
			}
			.small-field{
				width: 300px;
				font-family: arial, verdana;
				font-size: 15px;
				height: 30px;
				border: 1px solid #AAA;
			}
			.title{
				color: #063fa6;
				font-family: arial, verdana;
				font-size: 18px;
				font-weight: bold;
				padding-left: 20px;
				padding-top: 20px;
			}
			.text-content{
				font-family: arial, verdana;
				font-size: 13px;
				padding-left: 40px;
				
			}
			
			a:link{
					text-decoration: none;
					color: #063fa6;
			}
			a:active{
					text-decoration: none; 
					color: #063fa6;
			}
			a:visited{
					text-decoration: none;
					color: #063fa6;
			}
			a:hover{
				text-decoration: underline;
				color: #063fa6;
			}
			
			.button{
				background-color: #063fa6;
				color: white;
				height: 30px;
				width: 400px;
				border-radius: 5px 5px 5px 5px;
				cursor: pointer;
			}
			.small-button{
				background-color: #063fa6;
				color: white;
				height: 30px;
				width: 148px;
				border-radius: 5px 5px 5px 5px;
				cursor: pointer;
			}
			input:focus { /*unchange chrome's border*/
			  outline: none;
			}
			.infoclass{
				border-color: #03235f; 
				border-style: solid; 
				border-width: 2px; 
				background-color: #063FA6; 
				font-size: 13px; 
				text-align:center; 
				color: white; 
				text-weight: bold; 
				height: 25px;
			}
		</style>
	</head>
	<body>
		<div style="width: 1000px; margin-left: auto; margin-right: auto; background-image: url('img/fdcentro.png'); height: 100%;min-height: 200px;" >
			<?php
				if(isset($_SESSION["erro"])){
					echo "<div style='border-color: #b52727; border-style: solid; border-width: 2px; background-color: #c45555; font-size: 13px; text-align:center; color: white; text-weight: bold; height: 25px;'><div style='margin-top: 5px;'>Error: $_SESSION[erro]</div></div>";
					unset($_SESSION["erro"]);
				}
				if(isset($_SESSION["sucess"])){
					echo "<div style='border-color: #13a200; border-style: solid; border-width: 2px; background-color: #90d786; font-size: 13px; text-align:center; color: white; text-weight: bold; height: 25px;'><div style='margin-top: 5px;'>$_SESSION[sucess]</div></div>";
					unset($_SESSION["sucess"]);
				}
				if(isset($_GET["p"]) && $_GET["p"]) $url = $_GET["p"]; else $url= 'home';
				$url = str_replace(array('.', '..', '/'), '', $url);
				if(file_exists("pag/$url.php")) include "pag/$url.php"; else echo "Página não localizada";
			?>
			<div style='text-align: center; margin-top: 20px; margin-bottom: 20px;'>
			<a href="?p=home">INDEX</a> | <a href="?p=cadastre">CADASTRE</a> 
			<?php 
				if(login()){
					echo " | <a href='?p=exit&k=$_SESSION[data_real_login]'>EXIT</a>";
				}
			?>
			</div>
		</div>
		<div>
			<div style='width: 100px; margin-left: auto; margin-right: auto;'>
				<p style='display: block;'>
				     <a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
			    </p>
			</div>
		</div>
	</body>
</html>
