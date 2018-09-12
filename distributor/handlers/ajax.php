<?php
session_start();
include_once "../../inc/functions.php";
include_once "../../inc/db_functions.php";

$distributor_id = isset($_SESSION['distributor_id']) ? $_SESSION['distributor_id'] : null;
$distributor_name = isset($_SESSION['distributor_name']) ? $_SESSION['distributor_name'] : null;

function show_distributor_message($message)
{
	echo "
		<div class='form-group'>
		<span class='fa fa-lg fa-user pb-chat-fa-user'></span><br>
		" . $message->author . "
		<span class='label label-default pb-chat-labels pb-chat-labels-left'>
		" . $message->body . "</span>
		</div>
		<hr>
		";
}

function show_customer_message($message)
{
	echo "
		<div class='form-group pull-right pb-chat-labels-right'>
		<span class='label label-primary pb-chat-labels pb-chat-labels-primary'>
		" . $message->body . " :D</span>
		" . $message->author . "
		<span class='fa fa-lg fa-user pb-chat-fa-user'></span>
		</div><br><br>
		";
}

function show_messages($messages)
{
	foreach ($messages as $message) {
		if ($message instanceof DistributorMessage) {
			show_distributor_message($message);
		} else if ($message instanceof CustomerMessage) {
			show_customer_message($message);
		}
	}
}

$data = json_decode(file_get_contents('php://input'), true);
if (!empty($data) && $data['customer_id'] != null && $data['message'] != null) {
	$message = $data['message'];
	$customer_id = $data['customer_id'];
	$now = date("Y-m-d H:i:s");
	db_insert_distributor_message($distributor_id, $customer_id, $message, $now);
}

if (isset($_GET['action']) && isset($_GET['customer_id']) && isset($_GET['customer_name'])) {
	$customer_id = $_GET['customer_id'];
	$customer_name = $_GET['customer_name'];
	$customer_messages = db_get_customer_messages($customer_id, $customer_name, $distributor_id);
	$distributor_messages = db_get_distributor_messages($distributor_id, $distributor_name, $customer_id);

	if ($distributor_messages != null && !empty($distributor_messages)) {
		usort($distributor_messages, "date_comparator");
	}

	if ($customer_messages != null && !empty($customer_messages)) {
		usort($customer_messages, "date_comparator");
	}

	if ($distributor_messages != null && $customer_messages == null) {
		show_messages($distributor_messages);
		return;
	}

	if ($customer_messages != null && $distributor_messages == null) {
		show_messages($customer_messages);
		return;
	}

	$messages = array_merge($customer_messages, $distributor_messages);
	usort($messages, "date_comparator");
	show_messages($messages);
}