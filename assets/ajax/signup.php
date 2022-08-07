<?php 
session_start();
require '../php/functions.php';
// password
if(isset($_GET["password1"])&&!isset($_GET["password2"])){
	$password1=$_GET["password1"];
	}
 ?>

<!-- kalo akhirannya gmail, kasih info success -->
<?php if(isset($_GET["password1"])&&!isset($_GET["password2"])): ?>
<?php if((strlen($password1) > 8)): ?>
<div class="label">
	<label for="password3">Confirm Password</label>
</div>
<input type="password" class="showPassword3" id="password3" name="password2" pattern="[^' ']+" minlength="8"
	placeholder="*Confirm Password" autocomplete="off" required>
<?php endif; ?>
<?php endif; ?>