<div id="styleLogin">
	<input type="text" id="subValE" value="1" hidden>
</div>
<?php if(!isset($_SESSION['verificationForm'])&&!isset($_SESSION['changeForm'])): ?>
<!-- awal login form -->
<?php if(!isset($_SESSION['level'])&&!isset($_SESSION['verification'])) :?>
<div class="<?php if(!isset($_POST['login'])){echo"d-none";}?> form-login-float form-login">
	<button class="close" onclick="closeForm()"></button>
	<div class="content" id="login">
		<h1>LOG IN<span>.</span></h1>
		<?php if(isset($_SESSION["warningLogin"])): ?>
		<?php if($_SESSION["warningLogin"]!=='0'): ?>
		<i style="color:red;"><?= $_SESSION["warningLogin"]; ?></i>
		<?php endif; ?>
		<?php endif; ?>
		<form action="" method="post" name="form-login">
			<div class="email">
				<div class="label">
					<label for="email">Email</label>
				</div>
				<input type="email" id="email" name="email" required placeholder="Enter Email">
			</div>
			<div class="password">
				<div class="label">
					<label for="password1">Password</label>
					<i class="fas fa-eye-slash showPassword" onclick="showPassword()"></i>
				</div>
				<input type="password" class="showPassword1" id="password1" name="password" required
					placeholder="Enter Password">
			</div>
			<div class="remember">
				<div class="label">
					<input type="checkbox" class="checkbox" name="remember" id="remember"><label for="remember">Remember
						Me</label>
				</div>
			</div>
			<button type="submit" name="login"><span>CONTINUE</span> <svg xmlns="http://www.w3.org/2000/svg" width="25"
					height="25" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
					<path fill-rule="evenodd"
						d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
				</svg></button>
		</form>
		<a onclick="signup()">sign up?</a> <span>or</span> <a onclick="forgot()">forgot?</a>
	</div>
</div>

<!-- signup -->
<div
	class="<?php if(isset($_POST['login'])||!isset($_POST['signup'])||isset($_POST['forgot'])){echo"d-none";}?> form-login-float form-signup">
	<button class="close" onclick="closeForm()"></button>
	<div class="content">
		<h1>SIGN UP<span>.</span></h1>
		<?php if(isset($_SESSION["warningSignup"])): ?>
		<i style="color:red;"><?= $_SESSION["warningSignup"]; ?></i>
		<?php endif; ?>
		<form action="" method="post" name="form-signup">
			<div class="username">
				<div class="label">
					<label for="username">Name</label><i class="fas fa-check" id="checkN"></i>
				</div>
				<section class="input">
					<input type="text" id="username" name="username" maxlength="50" autocomplete="off" placeholder="Input Name"
						value="<?php if(isset($_SESSION['signupExist'])){echo"$username";}?>">
					<div class="i">
						<i class="fa-regular fa-circle-xmark d-none" id="iName1"></i>
						<i class="fa-regular fa-circle-check d-none" id="iName2"></i>
					</div>
				</section>
				<i class="validation" id="valN">Please enter your name</i>
			</div>
			<div class="email">
				<div class="label">
					<label for="email2">Email</label>
				</div>
				<section class="input">
					<input type="email" id="email2" name="email" maxlength="50" placeholder="Input Email"
						value="<?php if(isset($_SESSION['signupExist'])){echo"$email";}?>">
					<div class="i">
						<i class="fa-regular fa-circle-xmark d-none" id="iEmail1"></i>
						<i class="fa-regular fa-circle-check d-none" id="iEmail2"></i>
					</div>
				</section>
				<i class="validation" id="valE">Please enter your email</i>
			</div>
			<div class="password">
				<div class="label">
					<label for="password2">Password</label>
				</div>
				<section class="input">
					<input type="password" class="showPassword2" id="password2" name="password" placeholder="Create Password"
						autocomplete="off" value="<?php if(isset($_SESSION['signupExist'])){echo"$password";}?>">
					<div class="i">
						<i class="fa-regular fa-circle-xmark d-none" id="iPass1"></i>
						<i class="fa-regular fa-circle-check d-none" id="iPass2"></i>
					</div>
				</section>
				<i class="validation" id="valP1">Please creat your password</i>
			</div>
			<div class="password password-hide" id="confirm-password">
				<div class="label">
					<label for="password3">Confirm Password</label>
				</div>
				<section class="input">
					<input type="password" class="showPassword3" id="password3" class="password3" name="password2"
						placeholder="Confirm Password" autocomplete="off">
					<div class="i">
						<i class="fa-regular fa-circle-xmark d-none" id="iPassC1"></i>
						<i class="fa-regular fa-circle-check d-none" id="iPassC2"></i>
					</div>
				</section>
				<i class="validation" id="valP2">Please confirm your password</i>
			</div>
			<button type="submit" name="signup"><span><i
						class="fa fa-circle-o-notch fa-spin fa-spin-signup d-none"></i>CONTINUE</span> <svg
					xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right"
					viewBox="0 0 16 16">
					<path fill-rule="evenodd"
						d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
				</svg></button>
		</form>
		<a onclick="login()">have an account?</a> <span>or</span> <a onclick="forgot()">forgot?</a>
	</div>
</div>

<!-- forgot awal -->
<div
	class="<?php if(isset($_POST['login'])||isset($_POST['signup'])||!isset($_POST['forgot'])){echo"d-none";}?> form-login-float form-forgot">
	<button class="close" onclick="closeForm()"></button>
	<div class="content content-medium">
		<h1>FORGOT PW<span>.</span></h1>
		<?php if(isset($_SESSION["warningForgot"])): ?>
		<i style="color:red;"><?= $_SESSION["warningForgot"]; ?></i>
		<?php endif; ?>
		<form action="" method="post" onsubmit="loadingBtn('.fa-spin-forgot')" name="form-forgot">
			<div class="email">
				<div class="label">
					<label for="email3">Email</label>
				</div>
				<input type="email" id="email3" name="email" maxlength="50" placeholder="Search your account"
					value="<?php  if(isset($_POST['email'])){$email=$_POST['email']; echo"$email";}?>">
			</div>
			<button type="submit" name="forgot"><span><i
						class="fa fa-circle-o-notch fa-spin fa-spin-forgot d-none"></i>CONTINUE</span> <svg
					xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right"
					viewBox="0 0 16 16">
					<path fill-rule="evenodd"
						d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
				</svg></button>
		</form>
		<a onclick="login()">have an account?</a> <span>or</span> <a onclick="signup()">sign up?</a>
	</div>
</div>
<!-- forgot akhir -->
<!-- login -->
<script src="assets/js/functions.js"></script>
<script src="assets/js/login.js"></script>
<?php 
unset($_SESSION["warningLogin"]);
unset($_SESSION["warningSignup"]);
unset($_SESSION["warningForgot"]);
unset($_SESSION['signupExist']);
unset($_SESSION['changeForm']);
?>
<?php endif; ?>
<?php elseif(isset($_SESSION['verificationForm'])&&!isset($_SESSION['changeForm'])): ?>
<div class="form-login-float form-verification">
	<button class="close close-activation" onclick="closeForm()"></button>
	<div class="content content-medium">
		<h1>VERIFICATION<span>.</span></h1>
		<?php if(isset($_SESSION["warningVerification"])): ?>
		<i style="color:red;"><?= $_SESSION["warningVerification"]; ?></i>
		<?php endif; ?>
		<form action="" method="post" name="form-verificaton">
			<div class="verification">
				<input type="text" name="activation_code" required placeholder="*Check email" maxlength="6" autocomplete="off">
			</div>
			<button type="submit" name="verification"><span>CONTINUE</span> <svg xmlns="http://www.w3.org/2000/svg" width="25"
					height="25" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
					<path fill-rule="evenodd"
						d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
				</svg></button>
		</form>
		<form action="" method="post" style="display:inline-block;">
			<input type="hidden" hidden name="cancel">
			<a onclick="$(this).closest('form').submit();">cancel?</a>
		</form>
		<span>or</span>
		<form action="" method="post" style="display:inline-block;" onsubmit="loadingBtn()">
			<span id="demo"><i class='fa fa-circle-o-notch fa-spin' style='color:black;'></i></span>
			<input type="hidden" hidden name="resend">
		</form>
	</div>
</div>
<script>
// Set the date we're counting down to
// 1. JavaScript
// var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
// 2. PHP
var countDownDate = <?php echo strtotime($_SESSION['now']); ?> * 1000;
var now = <?php  echo time() ?> * 1000;

// Update the count down every 1 second
var x = setInterval(function() {

	// Get todays date and time
	// 1. JavaScript
	// var now = new Date().getTime();
	// 2. PHP
	now = now + 1000;

	// Find the distance between now an the count down date
	var distance = countDownDate - now;

	// Time calculations for days, hours, minutes and seconds
	var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	// Output the result in an element with id="demo"
	document.getElementById("demo").innerHTML = ('0' + minutes).slice(-2) + ":" + ('0' + seconds).slice(-2);

	// If the count down is over, write some text 
	if (distance < 0) {
		clearInterval(x);
		document.getElementById("demo").innerHTML =
			"<i class='fa fa-circle-o-notch fa-spin d-none' style='color:black;'></i><a  class='resend-form' onclick=" +
			"$(this).closest('form').submit();" +
			">resend?</a>";
	}
}, 1000);
</script>

<!-- verification -->
<script src="assets/js/verification.js"></script>
<?php
unset($_SESSION['signupExist']);
unset($_SESSION['changeForm']);
unset($_SESSION["warningVerification"]);
?>
<?php elseif(isset($_SESSION['verificationForm'])&&isset($_SESSION['changeForm'])): ?>
<!-- Change Password -->
<div class="form-login-float form-verification">
	<button class="close close-activation" onclick="closeForm()"></button>
	<div class="content content-medium">
		<h1>CHANGE PW<span>.</span></h1>
		<?php if(isset($_SESSION["warningChange"])): ?>
		<i style="color:red;"><?= $_SESSION["warningChange"]; ?></i>
		<?php endif; ?>
		<form action="" method="post" name="form-change">
			<div class="password">
				<div class="label">
					<label for="password2">New Password</label>
				</div>
				<section class="input">
					<input type="password" class="showPassword2" id="password2" name="password" placeholder="Create Password"
						autocomplete="off" value="<?php if(isset($_SESSION['signupExist'])){echo"$password";}?>">
					<div class="i">
						<i class="fa-regular fa-circle-xmark d-none" id="iPass1"></i>
						<i class="fa-regular fa-circle-check d-none" id="iPass2"></i>
					</div>
				</section>
				<i class="validation" id="valP1">Please creat your password</i>
			</div>
			<div class="password">
				<section id="confirm-password"></section>
				<div class="label">
					<label for="password3">Confirm Password</label>
				</div>
				<section class="input">
					<input type="password" class="showPassword3" id="password3" class="password3" name="password2"
						placeholder="Confirm Password" autocomplete="off">
					<div class="i">
						<i class="fa-regular fa-circle-xmark d-none" id="iPassC1"></i>
						<i class="fa-regular fa-circle-check d-none" id="iPassC2"></i>
					</div>
				</section>
				<i class="validation" id="valP2">Please confirm your password</i>
			</div>
			<button type="submit" name="changePassword"><span><i
						class="fa fa-circle-o-notch fa-spin fa-spin-signup d-none"></i>CONTINUE</span> <svg
					xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right"
					viewBox="0 0 16 16">
					<path fill-rule="evenodd"
						d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
				</svg></button>
		</form>
		<form action="" method="post" style="display:inline-block;">
			<input type="hidden" hidden name="cancel">
			<a onclick="$(this).closest('form').submit();">cancel?</a>
		</form>
	</div>
</div>
<script src="assets/js/functions.js"></script>
<script src="assets/js/verification.js"></script>
<?php 
unset($_SESSION['signupExist']);
unset($_SESSION["warningChange"]);
 ?>
<?php endif; ?>