<?php
require_once('config.php');
// FUNCTION FOR REMOVE ANNOUNCEMENT
if(isset($_POST['removeAnnouncementID'])){
	$removeAnnouncementID = $_POST['removeAnnouncementID'];
	$sql = "DELETE FROM `announcement` WHERE `announcement_id` = '$removeAnnouncementID'";
	$result = mysqli_query($con, $sql);
	if($result){
		echo 1;
		exit;
	}else{
		echo 0;
		exit;
	}
}

if(isset($_POST['deleteComplaint'])){
	$deleteComplaint = $_POST['deleteComplaint'];
	$sql = "DELETE FROM `complaint` WHERE `complaint_id` = '$deleteComplaint'";
	$result = mysqli_query($con, $sql);
	if($result){
		echo 1;
		exit;
	}else{
		echo 0;
		exit;
	}
}

// FUNCTION FOR REMOVE ANNOUNCEMENT
if(isset($_POST['removeResponse'])){
    $sql = "SELECT * FROM `inbox`";
	$result = mysqli_query($con,$sql) or die($con->error);
	if(mysqli_num_rows($result)>0){
	while($row = mysqli_fetch_array($result)){
        // CURRENT DATE FROM MANILA
		date_default_timezone_set("asia/manila");
		$currentdate = date("Y-m-d H:i:s");
		// VALID UNTIL / DATE EXPIRATION
		$expire = date('Y-m-d H:i:s', strtotime($row['date_time']. '+1 day'));
        if($currentdate >= $expire){
		   $sql2 = "UPDATE `inbox` SET `is_deleted` = 1";
           $result2 = mysqli_query($con,$sql2) or die($con->error);
           if($result2){}
        }
    }
	}	
}
?>