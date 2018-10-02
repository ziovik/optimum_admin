<!DOCTYPE html>
<?php session_start(); ?>

    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Заказчик | Login</title>
	<link rel="stylesheet" type="text/css" href="../css/style_login.css" media="all">
</head>
<body>



	<div class="login">
		<h2 style="color: white; text-align: center;"><?php  echo @$_GET['not_customer']; ?></h2>
		<h2 style="color: white; text-align: center;"><?php  echo @$_GET['logged_out']; ?></h2>
		<h1> ВХОД</h1>
		<form method="post">
			<input type="text" name="login" placeholder="Логин" required="required" autofocus="autofocus"/>
			<input type="password" name="pass" placeholder="Пароль" required="required" />
			<button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Войти.</button>
		</form>

		<p  style="color: white;">Если вы еще не зарегистрированы в системе, <a href="http://optimumsoft.ru/connect/" style="color: white;">заполните заявку</a>  </p>
	</div>
    

</body>
</html>

<?php

include("../inc/db.php");

if (isset($_POST['submit'])) {
	$login = $_POST['login'];
	$pass = $_POST['pass'];

	$sel_customer = "select 
	                     crd.id as id
	                from credentials crd 
	                join customer c on c.credentials_id = crd.id
	                where crd.login='$login' AND crd.password='$pass' ";

	$run_customer = mysqli_query($con, $sel_customer );

	$check_customer  = mysqli_num_rows($run_customer );

	if ($check_customer == 0 ) {
		echo "<script>alert('невервеный пароль или логин')</script>";
		exit();
	}else{

//             echo "<script>alert('Вы успешно вошлли в систему')</script>";  
			echo "<script>window.open('../optimum_beauty.php?logged_in=Вы успешно вошлли в систему','_self')</script>";
	}


	while($rows_customer = mysqli_fetch_array($run_customer)){
		$credential_id = $rows_customer['id'];

		$get_name = "select name as customer_name, id  from customer where credentials_id = '$credential_id'";

		$run_name = mysqli_query($con, $get_name);

		while($row_name = mysqli_fetch_array($run_name)){

			$customer_name = $row_name['customer_name'];

			$customer_id =$row_name['id'];

			$_SESSION['customer_id'] = $customer_id;

			$_SESSION['customer_name'] = $customer_name;


			 //checking cart too

			$status = 'active';
 

			$sel_cart ="select * from cart where customer_id='$customer_id'";

			$run_cart = mysqli_query($con, $sel_cart);

			$check_cart = mysqli_num_rows($run_cart);

			$insert_customer_cart = "insert into cart (customer_id,status) values ('$customer_id','$status')";

			if (  $check_cart == 0) {

                $run_customer_cart = mysqli_query($con, $insert_customer_cart);

				echo "<script>alert('$customer_name')</script>";
				echo "<script>window.open('../optimum_beauty.php?logged_in=Вы успешно вошлли в систему','_self')</script>";

			
			}else if($check_cart > 0){
              $found = false;
              while($rows = mysqli_fetch_array($run_cart)){
                    if($rows['status'] == 'active') {
                    	$found = true;
                    	break;
                    }
              }
              if(!$found){

                $run_customer_cart = mysqli_query($con, $insert_customer_cart);

                echo "<script>alert('$customer_name')</script>";
				echo "<script>window.open('../optimum_beauty.php?logged_in=Вы успешно вошлли в систему','_self')</script>";


              }
			}
		}
	}



}

?>
