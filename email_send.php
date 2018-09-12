<?php
 
 if (isset($_POST['submit'])) {
 	$msg = 'Name: ' .$_POST['name'] ."\n"
 	        .'Email: ' .$_POST['email'] ."\n"
 	        .'Telephone: ' .$_POST['tel'] . "\n"
 	         .'Comment: ' .$_POST['comment'];

 	mail('mondaydaniel2002@yahoo.com', 'Thank You from Optimum Beauty', $msg );
 	
 	header('location:email_thanks.php');   

}else {
 	header('location:email.php');
 	exit(0);
 }

?>
