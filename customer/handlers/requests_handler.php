<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/28/2018
 * Time: 1:18 PM
 */
session_start();
include_once "../../inc/functions.php";
include_once "../../inc/db_functions.php";
include_once "../../db_objects/CustomerMessage.php";
include_once "../../db_objects/DistributorMessage.php";

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

if (isset($_GET["action"])) {
	$action = $_GET["action"];

	switch ($action) {
		case "get_chat":
			get_chat_message();
			break;
		case "send_message_to_distributor":
			send_message_to_distributor_request($data);
			break;
		case "delete_product_from_cart":
			delete_product_from_active_cart_request($data);
			break;
		case "add_to_cart":
			add_to_cart_request($data);
			break;
		case "update_product_in_cart":
			update_product_in_cart_request($data);
			break;
		case "check_product_in_cart":
			check_product_in_cart_request($data);
			break;
	}
	return;
}

function delete_product_from_active_cart_request($data)
{
	if (empty($data)) {
		print_r("data is empty");
		return;
	}

	if (isset($data["id"])) {
		db_delete_product_from_active_cart($data["id"]);
	}
}

function check_product_in_cart_request($data)
{
	if (empty($data)) {
		print_r("data is empty");
		return;
	}

	if (isset($data["product_id"]) && isset($data["customer_id"])) {
		$product_id = $data["product_id"];
		$customer_id = $data["customer_id"];
		
		$cart_id = db_get_customer_active_cart_id($customer_id);
		$product_item = db_get_product_in_active_cart($product_id, $cart_id);
		if (isset($product_item)) {
			$result = array("id" => $product_item->id, "quantity" => $product_item->quantity);
			print_r(json_encode($result));
		} else {
			print_r(-1);
		}
	}
}

function add_to_cart_request($data)
{
	if (empty($data)) {
		print_r("data is empty");
		return;
	}

	if (isset($data["product_id"]) && isset($data["product_quantity"]) && isset($data["customer_id"])) {
		$product_id = $data["product_id"];
		$product_quantity = $data["product_quantity"];
		$customer_id = $data["customer_id"];
		$cart_id = db_get_customer_active_cart_id($customer_id);

		db_add_product_to_active_cart($product_id, $product_quantity, $cart_id);
		print_r("product was added into db");
	}
}

function update_product_in_cart_request($data)
{
	if (empty($data)) {
		print_r("data is empty");
		return;
	}

	if (isset($data["id"]) && isset($data["product_quantity"])) {
		$id = $data["id"];
		$product_quantity = $data["product_quantity"];

		db_update_product_in_active_cart($id, $product_quantity);
		print_r("product was updated in db");
	}
}

function send_message_to_distributor_request($data) {
	if (empty($data)) {
		print_r("data is empty");
		return;
	}

	if (isset($data["distributor_id"]) && isset($data["message"]) && isset($data["customer_id"])) {
		$message = $data["message"];
		$distributor_id = $data["distributor_id"];
		$customer_id = $data["customer_id"];
		$now = date("Y-m-d H:i:s");
		db_insert_customer_message($customer_id, $distributor_id, $message, $now);
	}
}

function get_chat_message() {
	if (!empty($_GET["customer_id"]) && !empty($_GET["customer_name"])
			&& !empty($_GET["distributor_id"]) && !empty($_GET["distributor_name"])) {
		$customer_id = $_GET["customer_id"];
		$customer_name = $_GET["customer_name"];
		$distributor_id = $_GET["distributor_id"];
		$distributor_name = $_GET["distributor_name"];

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
}