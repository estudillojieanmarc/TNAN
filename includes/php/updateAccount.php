<?php
    session_start();

    require_once('connection.php');
    $accountUsername = $_POST["accountUsername"];
    $accountPassword = $_POST["accountPassword"];
    $customerPassword = md5($accountPassword);

    $sql = "UPDATE `customers` SET `customerUsername` = '$accountUsername', `customerPassword` = '$customerPassword'  WHERE `customerID` = '$_SESSION[uid]'";
    $result = mysqli_query($con, $sql);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
?>