<div class="infoclass">
	<div style='margin-top: 5px;'>Hello! You need login to continue</div>
</div>
<div style='width: 320px; margin-left: auto; margin-right: auto;'>
	<form action="index.php" method="post">
		<div class='title'>Login: </div>
		<div>
			<input type="text" name="login" class='small-field' id='loginField' />
		</div>
		<div class='title'>Password: </div>
		<div>
			<input type="password" name="password" class='small-field' />
		</div>
		<div style="margin-top: 20px;">
			<input type="submit" value="Login" class="small-button" />
			<input type="reset" value="Clear" class="small-button" />
		</div>
	</form>
</div>
<script type="text/javascript">
	document.getElementById('loginField').focus();
</script>
