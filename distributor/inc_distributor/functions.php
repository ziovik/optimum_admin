<?php
include("../inc/db.php");


mysqli_set_charset($con, "utf8");
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 9/26/2018
 * Time: 11:24 AM
 */
function message_count(){
    global $con;
   if (isset($_SESSION['distributor_id'])) {
       $dist_id = $_SESSION['distributor_id'];


           $sql = "select * from customer_chat where distributor_id = '$dist_id'and status='unread' ";
           $result = mysqli_query($con, $sql);

           $count_message = mysqli_num_rows($result);
           echo $count_message;



       }
    if (isset($_REQUEST['customer_id'])) {
        if (isset($_SESSION['distributor_id'])) {
            $dist_id = $_SESSION['distributor_id'];
            $customer_id = $_REQUEST['customer_id'];
            $sql = "update customer_chat set status = 'read' where distributor_id = $dist_id and customer_id ='$customer_id'";
            mysqli_query($con, $sql);

        }

    }
}

