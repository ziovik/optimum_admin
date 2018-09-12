<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 28.08.18
 * Time: 18:00
 */

function show_message($message)
{
	echo "<script>console.log('$message')</script>";
}

$data = json_decode(file_get_contents('php://input'), true);
if (!empty($data) && $data['message'] != null) {
	print_r($data['message']);
} else {
	print_r('No message');
}

/*if (empty($_POST)) {
	show_message("Post is empty");
} else {
	if (isset($_POST["message"])) {
//	$message = $_POST['message'];
		$message = json_decode($_POST['message']);
		show_message($message);
	}
}*/

