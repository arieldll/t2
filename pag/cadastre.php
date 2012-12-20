<?php 
	function f($field){
		if(isset($_SESSION["website_data"]) && isset($_SESSION["website_data"]))  echo $_SESSION["website_data"][$field]; else return "";
	}
?>
<div class="infoclass">
	<div style='margin-top: 5px'>Fill your information</div>	
</div>
<div style='width: 320px; margin-left: auto; margin-right: auto;'>
	<form action="?p=cadastre" method="post">
		
		<div class='title'>Login: </div>
		<div>
			<input type="text" name="clogin" class='small-field' value='<?php f('clogin'); ?>' id='loginField' />
		</div>
		<div class='title'>Name: </div>
		<div>
			<input type="text" name="cname" class='small-field' value='<?php f('cname'); ?>' />
		</div>
		<div class='title'>Password: </div>
		<div>
			<input type="password" name="password" class='small-field' value='<?php f('password'); ?>' />
		</div>
		<div class='title'>Confirm your password: </div>
		<div>
			<input type="password" name="cpassword" class='small-field' value='<?php f('cpassword'); ?>' />
		</div>
		<div style="margin-top: 20px;">
			<input type="submit" value="Send" class="small-button" />
			<input type="reset" value="Clear" class="small-button" />
		</div>
	</form>
</div>
<script type="text/javascript">
	document.getElementById('loginField').focus();
</script>

