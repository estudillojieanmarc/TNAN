<?php
    session_start();
    include('config.php');
        $foodStatusID = $_POST['foodStatusID'];
        $newStatus = 0;
        $sql = "SELECT foodStock FROM food WHERE foodID = $foodStatusID";
        $result = mysqli_query($con,$sql) or die($con->error);
        if(mysqli_num_rows($result) > 0){
            while($product = mysqli_fetch_array($result)){	
                if($product['foodStock'] == 0){
                    echo 2;
                }else{
                    $sql = "UPDATE `food` SET `foodStatus` = '$newStatus' WHERE `foodID` = '$foodStatusID'";
                    $update = mysqli_query($con, $sql);
                        if($update){
                            echo 1;
                        }else{
                            echo 0;
                        }
                }
            }
        }


?>