<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/28/2018
 * Time: 1:18 PM
 */
session_start();
include("../../inc/functions.php");
include("../../inc/db_functions.php");

$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : null;
$customer_name = isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : null;

function show_distributor_message($message)
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

function show_customer_message($message)
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
if (!empty($data) && $data['distributor_id'] != null && $data['message'] != null) {
	$message = $data['message'];
	$distributor_id = $data['distributor_id'];
	$now = date("Y-m-d H:i:s");
	insert_customer_message($customer_id, $distributor_id, $message, $now);
/*
	print_r("customer_id: " . $customer_id . "\r\n");
	print_r("distributor_id: " . $distributor_id . "\r\n");
	print_r("now: " . $now . "\r\n");*/
}

if (!empty($_GET["action"]) && !empty($_GET["distributor_id"]) && !empty($_GET["distributor_name"])) {
	$distributor_id = $_GET["distributor_id"];
	$distributor_name = $_GET["distributor_name"];
	$customer_messages = get_customer_messages($customer_id, $customer_name, $distributor_id);
	$distributor_messages = get_distributor_messages($distributor_id, $distributor_name, $customer_id);

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
