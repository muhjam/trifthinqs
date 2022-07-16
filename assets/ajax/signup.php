<?php 
require '../php/functions.php';

// email
if(isset($_GET['email'])){
$email1=$_GET["email"];

$email=strtolower(str_replace("'","",$email1));


$queryEmail="SELECT * FROM users WHERE status='on' AND email='$email' OR status='ban' AND email='$email'
					";


$resultEmail= query($queryEmail);


}

// name
if(isset($_GET["username"])){

$username=$_GET["username"];

}

// password
if(isset($_GET["password1"])&&!isset($_GET["password2"])){
$password1=$_GET["password1"];
}

// confirm password
if(isset($_GET["password1"])&&isset($_GET["password2"])){
$password2=$_GET["password2"];
$password1=$_GET["password1"];
}



$valEmail='/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'

// ^([a-zA-Z]+)$

?>

<?php if(isset($_GET['email'])): ?>


<?php if(!preg_match ($valEmail, $email)): ?>


<?php if(!empty($email)): ?>
<label for="email" class="form-label email" style="color:;">Email <i>'@gmail.com!'</i></label>
<style>
.email {
	color: orange;
}

#email {
	border: 1px solid orange;
}

input[type=email]:focus {

	box-shadow: 0 0 5px 1px orange;
	/* oranges! yey */
}
</style>
<?php else: ?>
<label for="email" class="form-label email" style="color:;">Email</label>
<?php endif; ?>


<?php else: ?>



<?php if(empty($email)): ?>
<label for="email" class="form-label email" style="color:;">Email</label>

<?php elseif(empty($resultEmail)): ?>
<label for="email" class="form-label email" style="color:;">Email <i>'@gmail.com!'</i></label>
<style>
.email {
	color: orange;
}

#email {
	border: 1px solid orange;
}

input[type=email]:focus {

	box-shadow: 0 0 5px 1px orange;
	/* oranges! yey */
}
</style>


<?php if($email=='@gmail.com'): ?>
<style>
.email {
	color: orange;
}

#email {
	border: 1px solid orange;
}

input[type=email]:focus {

	box-shadow: 0 0 5px 1px orange;
	/* oranges! yey */
}
</style>





<!-- kalo akhirannya gmail, kasih info success -->
<?php elseif(substr($email, -10)=='@gmail.com'): ?>
<i class="fas fa-check"></i>
<style>
i {
	display: none;
}

i.fas {
	display: inline-block;
	color: green;
	;
}

.email {
	color: green;
}

#email {
	border: 1px solid green;
}

input[type=email]:focus {

	box-shadow: 0 0 5px 1px green;
	/* oranges! yey */
}
</style>
<?php endif; ?>

<?php elseif(!empty($resultEmail)): ?>
<label for="email" class="form-label email">Email <i>'akun ini sudah terdaftar!'</i> </label>
<style>
.email {
	color: red;
}

#email {
	border: 1px solid red;
}

input[type=email]:focus {

	box-shadow: 0 0 5px 1px red;
	/* oranges! yey */
}
</style>
<?php endif; ?>




<?php endif; ?>







<?php endif; ?>



<!-- name -->

<!-- kalo akhirannya gmail, kasih info success -->
<?php if(isset($_GET["username"])): ?>

<?php if($username != ''):?>



<?php if(!preg_match ('/^([a-z A-Z]+)$/', $username)): ?>

<label for="username" class="form-label username">Name <i class="info3">'[a-z A-Z]!'</i></label>


<style>
i.info3 {
	display: inline-block;
}

.username {
	color: red;
}

#username {
	border: 1px solid red;
}

input#username:focus {

	box-shadow: 0 0 5px 1px red;
	/* oranges! yey */
}
</style>

<?php else: ?>

<label for="username" class="form-label username">Name</label>


<i class="fas fa-check"></i>
<style>
i.fas {
	display: inline-block;
	color: green;
}

.username {
	color: green;
}

#username {
	border: 1px solid green;
}

input#username:focus {

	box-shadow: 0 0 5px 1px green;
	/* oranges! yey */
}
</style>

<?php endif; ?>

<?php elseif($username==''): ?>
<label for="username" class="form-label username">Name</label>
<?php endif; ?>

<?php endif; ?>





<!-- password -->

<!-- kalo akhirannya gmail, kasih info success -->
<?php if(isset($_GET["password1"])&&!isset($_GET["password2"])): ?>

<?php if($password1 != ''):?>
<label for="usernameexampleDropdownFormPassword1" class="form-label password1">Password <i class="info2">(min 8
		length)</i> </label>
<style>
.password1 {
	color: orange;
}

#exampleDropdownFormPassword1 {
	border: 1px solid orange;
}


input#exampleDropdownFormPassword1:focus {

	box-shadow: 0 0 5px 1px orange;
	/* oranges! yey */
}
</style>

<?php if((strlen($password1) > 8)): ?>

<i class="fas fa-check"></i>
<style>
i.fas {
	display: inline-block;
	color: green;
}

i.info2 {
	display: none;
}

.password1 {
	color: green;
}

#exampleDropdownFormPassword1 {
	border: 1px solid green;
}

input#exampleDropdownFormPassword1:focus {

	box-shadow: 0 0 5px 1px green;
	/* oranges! yey */
}

#confirmPassword {
	display: block !important;
}
</style>


<?php endif; ?>


<?php elseif($password1==''): ?>
<label for="exampleDropdownFormPassword1" class="form-label password1">Password</label>
<?php endif; ?>

<?php endif; ?>



<!-- confirm password -->

<?php if(isset($_GET["password1"])&&isset($_GET["password2"])): ?>

<?php if($password2==''): ?>
<label for="exampleDropdownFormPassword2" class="form-label password2">Confirm Password</label>
<?php elseif($password2!=''): ?>
<label for="exampleDropdownFormPassword2" class="form-label password2">Confirm Password</label>
<style>
.password2 {
	color: orange;
}

#exampleDropdownFormPassword2 {
	border: 1px solid orange;
}


input#exampleDropdownFormPassword2:focus {

	box-shadow: 0 0 5px 1px orange;
	/* oranges! yey */
}
</style>


<?php if($password1 === $password2): ?>

<i class="fas fa-check"></i>
<style>
i.fas {
	display: inline-block;
	color: green;
}


.password2 {
	color: green;
}

#exampleDropdownFormPassword2 {
	border: 1px solid green;
}

input#exampleDropdownFormPassword2:focus {

	box-shadow: 0 0 5px 1px green;
	/* oranges! yey */

}
</style>
<?php endif; ?>



<?php endif; ?>

<?php endif; ?>