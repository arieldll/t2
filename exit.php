<?php
	@session_start();
	if(isset($_SESSION["data_real_login"]) && $_GET['k']==md5(date('H').$_SESSION['ulo'])){
		unset($_SESSION['ulo']);
		unset($_SESSION["data_real_login"]);
	}
	header("Location: index.php?p=home");
?>
