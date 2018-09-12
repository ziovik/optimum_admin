
<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style_login.css" media="all">
</head>
<body>



<div class="login">
	<h2 style="color: white; text-align: center;"><?php  echo @$_GET['not_admin']; ?></h2>
	<h2 style="color: white; text-align: center;"><?php  echo @$_GET['logged_out']; ?></h2>
	<h1> Admin Login</h1>
    <form method="post">
    	<input type="text" name="email" placeholder="Email" required="required" />
        <input type="password" name="pass" placeholder="Password" required="required" />
        <button type="submit" name="login" class="btn btn-primary btn-block btn-large">Log me in.</button>
    </form>
</div>


</body>
</html>

<?php



if (isset($_POST['login'])) {
	include("../inc/db.php");

	  $email = $_POST['email'];
	  $pass = $_POST['pass'];

	  $sel_user = "select * from admins where user_email='$email' AND user_pass='$pass'";

	  $run_user = mysqli_query($con, $sel_user);

	  $check_user = mysqli_num_rows($run_user);

	  if ($check_user == 1) {
	  	
	  	$_SESSION['user_email'] = $email;
         echo "<script>alert('successfully Admin ')</script>";
	  	echo "<script>window.open('index1.php?logged_in=You have successfully Logged into Admin','_self')</script>";
	  }

	  else{
	  	echo "<script>alert('Password or Email is wrong')</script>";
	  	
	  }



}

?>