<?php
    error_reporting(0);
    session_start();    
    require_once('connection.php');
    $user_id = $_POST['user_id'];
    $total_amount = $_POST['total_amount'];
    $payment_option = $_POST['payment_option'];
    $quantity = $_POST['quantity'];
    $total = $_POST['total'];
    $price = $_POST['price'];
    $foodDescription = $_POST['foodDescription'];
    $foodID = $_POST['foodID'];
    $Order = "Order";

    // PAYMENT
    $sql = "INSERT INTO `order_manager`(`user_id`, `total_amount`, `payment_option`, `date_time_bought`, `order_status`)
    VALUES ('$user_id', '$total_amount', '$payment_option', now(), '$Order')";
    $result = mysqli_query($con,$sql);
    if($result){
        // INSERT ORDER TO DB 
    $order_id = mysqli_insert_id($con);
    $sql2 = "INSERT INTO `user_orders` (`order_id`, `product`, `product_price`, `quantity`, `total`, `date_time_bought`) 
    VALUES ('$order_id','$foodDescription', '$price', '$quantity', '$total',now())";
    $result2 = mysqli_query($con,$sql2);
        if($result2){
            // DELETE CART
            $sql3 = "DELETE FROM `cart` WHERE `user_id` = '$user_id'";
            $result3 = mysqli_query($con,$sql3);
            if($result3){
                echo 1;
                exit();
            }
        }
    }else{
        echo 0;
        exit();
    }
?>