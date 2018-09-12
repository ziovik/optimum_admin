<!DOCTYPE html>
<?php session_start();
include("../inc/db.php");
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Distributor Login</title>
	<link rel="stylesheet" type="text/css" href="../css/style_login.css" media="all">
</head>
<body>


<div class="login">
	<h2 style="color: white; text-align: center;"><?php echo @$_GET['not_dist']; ?></h2>
	<h2 style="color: white; text-align: center;"><?php echo @$_GET['logged_out']; ?></h2>
	<h1> Вход</h1>
	<form method="post">
		<input type="text" name="login" placeholder="логин..." required="required" autofocus="autofocus"/>
		<input type="password" name="pass" placeholder="пароль..." required="required"/>
		<button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Вход</button>
	</form>
</div>


</body>
</html>
<?php


if (isset($_POST['submit'])) {
	$dist_login = $_POST['login'];

	$pass = $_POST['pass'];

	$sel_distributor = "select 
	                         c.id as credential_id, 
	                         d.id as distributor_id,
	                         com.name as distributor_name,
	                         c.login as login

	                    from credentials c
	                    join distributor d on d.credentials_id = c.id
	                    join company com on com.id = d.company_id

	                    where c.login='$dist_login' AND c.password='$pass'";

	$run_distributor = mysqli_query($con, $sel_distributor);

	$check_distributor = mysqli_num_rows($run_distributor);

	if ($check_distributor == 0) {
		echo "<script>alert('невервеный пароль или логин')</script>";
		exit();
	}

	while ($rows_distributor = mysqli_fetch_array($run_distributor)) {
		$credential_id = $rows_distributor['credential_id'];

		$dist_id = $rows_distributor['distributor_id'];
		$distributor_name = $rows_distributor['distributor_name'];

		$_SESSION['distributor_name'] = $distributor_name;

		$_SESSION['distributor_id'] = $dist_id;


		echo "<script>alert('Вы успешно вошлли в систему')</script>";
		echo "<script>window.open('index.php','_self')</script>";
	}
}
?>
