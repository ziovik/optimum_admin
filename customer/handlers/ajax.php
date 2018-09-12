<?php
session_start();
include("../inc/db.php");

function showMessage($message)
{
    echo "<script>console.log('$message')</script>";
}

if (isset($_REQUEST['action'])) {

    $action = $_REQUEST['action'];
    $customer_id = $_SESSION['customer_id'];
    showMessage($customer_id);




    switch ($_REQUEST['action']) {

        case "SendMessage":
            showMessage($distributor_id);
            $message = $_REQUEST['Message'];  // action is calling message inputed


            $sql = "insert into customer_chat set user = '$customer_name', message ='$message', customer_id = '$customer_id', distributor_id = '$distributor_id'";
            $run = mysqli_query($con, $sql);

            echo "Success";

            break;

        case "getChat":

            $sql_customer_message = "select 
                                        * 
                                        from customer_chat 
                                        where 
                                        customer_id ='$customer_id' and  distributor_id = '$distributor_id'  ";


            $run_customer = mysqli_query($con, $sql_customer_message);

            while ($rows = mysqli_fetch_array($run_customer)) {

                $chat = $rows['Message'];
                $user = $rows['user'];

                echo "
                        <div class='form-group'>
                        <span class='fa fa-lg fa-user pb-chat-fa-user'></span><br>" . $rows['user'] . "<span class='label label-default pb-chat-labels pb-chat-labels-left'>" . $rows['Message'] . "</span>
                        </div>
                        <hr>
                        ";

            }

            $get_dist_message = "select 

                                    *
                                    from distributor_chat

                                    where  customer_id ='$customer_id' AND distributor_id = '$distributor_id' ";

            $run_dist = mysqli_query($con, $get_dist_message);

            while ($row_dist = mysqli_fetch_array($run_dist)) {

                $chat = $row_dist['Message'];
                $user = $row_dist['user'];

                echo "


                    <div class='form-group pull-right pb-chat-labels-right'>
                        <span class='label label-primary pb-chat-labels pb-chat-labels-primary'>" . $row_dist['Message'] . " :D</span>" . $row_dist['user'] . "<span class='fa fa-lg fa-user pb-chat-fa-user'>
                        </span>
                    </div><br><br>


                    ";


            }
            break;
    }
}
?>