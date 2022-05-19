<?php
session_start();
require_once "connection.php";

// FETCH IMAGE AND NAME FROM DATABASE
if(isset($_POST["identification"])){
	$category_query = "SELECT * FROM `customers` WHERE `customerID` = '$_SESSION[uid]' ";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$customerName = $row["customerName"];
			$customerImage = $row["customerImage"];
			echo "
				<img style='clip-path:circle(); height:25px; width:25px; margin:-4px 7px 0 0' src='/TNAN/admin/assets/customersPhoto/$customerImage'><span>$customerName</span>
				";
		}
	}
}

// FETCH CATEGORY
if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills nav-stacked col-1	'>
		<li class='nav-item'><a class='nav-link text-dark' style='letter-spacing:1px; padding-left:1px; font-family:'Alegreya', serif;' href='/TNAN/shop.php'>||All</a></li>
		";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["categories_ID"];
			$cat_name = $row["categories"];
			echo "
                <li class='nav-item'><a class='nav-link category text-dark' style='letter-spacing:1px; padding-left:2px; font-family:'Alegreya', serif;' href='#' cid='$cid'>||$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}

// PAGE LIMIT FUNCTION
if(isset($_POST["page"])){
	$sql = "SELECT * FROM food";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/12);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li class='nav-item mx-1'><a class='btn btn-sm btn-outline-secondary px-3' href='#' page='$i' id='page'>$i</a></li>
		";
	}
}

// FETCH PRODUCT FROM DATABASE
if(isset($_POST["getProduct"])){
	$limit = 12;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM food WHERE foodStatus = 0 LIMIT $start,$limit ";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$foodID     = $row['foodID'];
			$foodImage   = $row['foodImage'];
			$foodName = $row['foodName'];
			$foodCategory = $row['foodCategory'];
			$foodDescription = $row['foodDescription'];
			$foodPrice = $row['foodPrice'];
			echo "
				<div class='col-3 py-2'>
					<div class='card'>
						<div style='font-weight:500;' class='card-heading px-3 pt-2'>
							$foodName
						</div>
						<div class='card-body'>
							<img class='card-img-top' src='/TNAN/admin/assets/foodPhoto/$foodImage' style='width:220px; height:200px;'/>
							<p class='card-text text-dark py-2' style='font-size:14px;'>$foodDescription</p>
							<div class='row my-3'>
								<italic class='text-secondary' style='font-size:18px;'>₱$foodPrice.00</italic>
							</div>
							</div>
					<button pid='$foodID' id='addCart' style='font-size:13px;' class='btn text-white '><i class='fas fa-cart-plus'></i> Add to cart</button>
					</div>
				</div>	
			";
		}
	}
}

// SEARCH FUNCTION
if(isset($_POST["get_seleted_Category"]) || isset($_POST["search"])){
	sleep(1);
	if(isset($_POST["search"])){
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM food WHERE foodName LIKE '%$keyword%' AND `foodStatus` = 0";
	}else{
		$id = $_POST["categories_ID"];
		$sql = "SELECT * FROM food  WHERE foodCategory = '$id' AND `foodStatus` = 0";
	}
	$run_query = mysqli_query($con,$sql);
	if(mysqli_num_rows($run_query)>0)
	{
	while($row=mysqli_fetch_array($run_query)){
			$foodID     = $row['foodID'];
			$foodImage   = $row['foodImage'];
			$foodName = $row['foodName'];
			$foodCategory = $row['foodCategory'];
			$foodDescription = $row['foodDescription'];
			$foodPrice = $row['foodPrice'];
			echo "
			<div class='col-3 py-2'>
				<div class='card bg-light'>
					<div class='card-heading px-3 pt-2 text-danger'>
						$foodName
					</div>
					<div class='card-body'>
						<img class='card-img-top' src='/TNAN/admin/assets/foodPhoto/$foodImage' style='width:220px; height:200px;'/>
						<p class='card-text text-dark py-2' style='font-size:14px;'>$foodDescription</p>
						<div class='row my-3'>
							<italic class='text-secondary' style='font-size:18px;'>₱$foodPrice.00</italic>
						</div>
						<div class='row px-2'>
							<button pid='$foodID' id='addCart' style='font-size:13px;' class='btn text-white btn-sm'>Add to cart</button>
						</div>
					</div>
				</div>
			</div>	
		";
		}
	}else{
		echo "
			<div class='alert bg-light text-danger text-center' role='alert'><h5>No available product</h5></div>
		";
	}
}

// ADD TO CART METHOD
if(isset($_POST["addToCart"])){
	$p_id = $_POST["proId"];
	if(isset($_SESSION["uid"])){
		$user_id = $_SESSION["uid"];
		$sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
			if($count > 0){
				echo "Product is already added, Please Continue Shopping";
			}else {
			$sql = "INSERT INTO `cart` (`p_id`, `user_id`, `qty`) VALUES ('$p_id','$user_id','1')";
			$run_query = mysqli_query($con,$sql);
				if($run_query){
					echo "Your product has been added to cart, Please Continue Shopping";
			}
		}
	}
}

// FUNCTION FOR ADDING QTY IN CART BADGE
if (isset($_POST["count_item"])) {
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
	}
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_item"];
	exit();
}

// FUNCTION FOR ADDING QTY IN INBOX BADGE
if (isset($_POST["count_message"])) {
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_message FROM inbox WHERE is_deleted = 0 AND  user_id = $_SESSION[uid]";
	}
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_message"];
	exit();
}

// FUNCTION FOR ADDING QTY IN ANNOUNCEMENT BADGE
if (isset($_POST["count_announcement"])) {
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_announcement FROM announcement";
	}
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_announcement"];
	exit();
}

// FUNCTION FOR ADDING QTY IN PENDING BADGE
if (isset($_POST["count_pending"])) {
	if (isset($_SESSION["uid"])) {
		$deliver = "Deliver";
		$sql = "SELECT COUNT(*) AS count_pending FROM order_manager WHERE order_status = '$deliver' AND `user_id` = '$_SESSION[uid]'";
	}
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_pending"];
	exit();
}

// FUNCTION FOR DISPLAY THE CART DETAILS IN MODAL
if (isset($_POST["Common"])) {
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT a.foodID,a.foodImage,a.foodDescription,a.foodPrice,b.id,b.qty FROM food a,cart b WHERE a.foodID = b.p_id AND b.user_id = '$_SESSION[uid]'";
	}
	$query = mysqli_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		//DISPLAY ITEM IN MODAL
		if (mysqli_num_rows($query) > 0) {
			?>
			<div class="row cart">
			<form id="checkoutForm">
				<div class="col">
					<table class="table-responsive">
					<thead class="text-center">
						<tr>
							<th>No.</th>
							<th>Image</th>
							<th>Order</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Total</th>
							<th><button type="button" class="btn btn-sm btn-danger removeAll">Clear Cart</button></th>
						</tr>
					</thead>	
				</div>
			</div>
			<?php
			$n=0;
			while ($row=mysqli_fetch_array($query)) {
				$n++;
				$cartID = $row["id"];
				$foodID = $row["foodID"];
				$foodImage = $row["foodImage"];
				$foodDescription = $row["foodDescription"];
				$foodPrice = $row["foodPrice"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<tbody class="text-center" style="font-size:14.5px;">
						<tr>
							<input type="hidden" name="foodID" id="foodID" value='.$foodID.'>
							<input type="hidden" name="cart_ID" id="cart_ID" value='.$cartID.'>
							<td class="col-1">'.$n.'.</td>
							<td class="col-2"><img class="img-responsive img-thumbnail" style="height:100px; width:100px;" src="/TNAN/admin/assets/foodPhoto/'.$foodImage.'"/></td>
							<td class="col-2 foodDescription">'.$foodDescription.'</td>
							<td class="col-2 foodPrice">₱'.$foodPrice.'.00<input class="price" type="hidden" name="price" value='.$foodPrice.'></td>
							<td class="col-1"><input class="form-control quantity" name="quantity" type="number" min="1" value='.$qty.' onchange="net_total()"></td>
							<td class="col-2 fw-bold text-center">₱<span class="total"></span>.00</td>
							<td class="col-2">
							<button remove_id="'.$foodID.'" class="btn btn-outline-danger remove" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove item?"><i class="fas fa-trash-alt"></i></button> 
							<button update_id="'.$foodID.'" class="btn btn-outline-success update" data-bs-toggle="tooltip" data-bs-placement="top" title="Save Changes?"><i class="fas fa-check-circle"></i></button>
							</td>
						</tr>
					</tbody>
					';
				}
				?>
				</table>
				<?php
				echo '
				<div class="card ms-auto p-2" style="width: 15rem;">
					<div class="card-body">
						<input type="hidden" name="user_id" id="user_id">
						<div class="row">
							<div class="col-md-12">
								<b class="text-dark px-1" style="font-size:16px;">TOTAL AMOUNT:</b>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-md-12">
								<span style="font-size:19px;" class="text-dark px-5 fw-bold">₱<span name="total_amount" id="total_amount"></span>.00</span>
							</div>
						</div>
						<div class="form-check mt-2">
						<input class="form-check-input" value="Cash On Delivery" type="radio" name="payment_option" checked>
						<label class="form-check-label">
							Cash On Delivery
						</label>
						</div>
						<div class="form-check">
						<input class="form-check-input" value="Paypal" type="radio" name="payment_option">
						<label class="form-check-label">
							Paypal
						</label>
						</div>
						<div class="row mt-3">
							<button type="button" id="checkoutBtn" class="btn btn-sm btn-primary checkoutBtn"> <i class="fab fa-paypal"></i> CHECKOUT NOW </button>
						</div>
					</div>
				</div>
				</form>
				';
			exit();
		}else{
			echo '
					<div class="row text-center">
						<div class="col-md-12 py-3 mt-5"><h5>YOUR CART IS EMPTY</h5></div>
					</div>
					<div class="row text-center">
						<div class="col-md-12 mb-5"><a class="btn btn-danger btn-sm" href="/TNAN/shop.php">Go Order Now</a></div>
					</div>
					';
		}
	}
}

// REMOVE ITEM FROM THE CART
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
	}
	if(mysqli_query($con,$sql)){
		echo 1;
		exit();
	}
}

// REMOVE ALL ITEM FROM THE CART
if (isset($_POST["removeAll"])) {
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM `cart` WHERE `user_id` = '$_SESSION[uid]'";
	}
	if(mysqli_query($con,$sql)){
		echo 1;
		exit();
	}
}

// UPDATE ITEM FROM THE CART
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["quantity"];
	if (isset($_SESSION["uid"])) {
		$sql = "UPDATE `cart` SET `qty` = '$qty' WHERE `p_id` = '$update_id' AND `user_id` = '$_SESSION[uid]'";
	}
	if(mysqli_query($con,$sql)){
		echo 1;
		exit();
	}
}

// FUNCTION FETCH INBOX MESSAGE FROM THE DATABASE
if(isset($_POST["inboxID"])){
	$inboxQuery = "SELECT a.inbox_id, a.user_Id, a.message, a.date_time , a.is_deleted, b.customerID, b.customerName FROM inbox a , customers b WHERE a.user_Id = b.customerID AND a.is_deleted = 0 AND a.user_Id = $_SESSION[uid] ";
	$run_query = mysqli_query($con,$inboxQuery);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$inbox_id = $row['inbox_id'];
			$user_Id   = $row['user_Id'];
			$message   = $row['message'];
			$date_time = $row['date_time'];
			$customerID = $row['customerID'];
			$customerName = $row['customerName'];
			$newDate = date('F d, Y',strtotime($date_time));
			echo "
			<div class='card mt-3'>
				<div class='card-body'>
					<div class='row'>
						<div class='col-7' style='line-height:13px'>
							<p class='card-title text-dark fw-bold' style='font-size:16px text-transform:capitalize'>From Admin,</p>
							<p class='card-title text-dark' style='font-size:14px'>$newDate,</p>
						</div>
					</div>
					<div class='row mt-3'>
						<div class'col' style='line-height:18px'>
							<p class='card-text fw-bold text-secondary'style='font-size:15px'>Message:</p>
							<p class='card-text px-3 mb-4'style='font-size:15px'>$message</p>
						</div>
					</div>
				</div>
				<button class='btn btn-outline-danger btn-sm' onclick='removeMessage($inbox_id)'>Remove Message</button>
			</div>         
			";
		}
	}else{
		echo "
		<div class='my-5'>
					<h5 class='text-center'>NO MESSAGE FOR YOU</h5>
			</div>   
		
		";
	}
}

// FUNCTION FOR REMOVE INBOX MESSAGE
if(isset($_POST['inboxMessage'])){
	$inbox = $_POST['inboxMessage'];
	$sql = "UPDATE `inbox` SET `is_deleted` = 1 WHERE `inbox_id` = '$inbox'";
	$result = mysqli_query($con, $sql);
	if($result){
		echo 1;
		exit;
	}else{
		echo 0;
		exit;
	}
}

// FUNCTION FETCH ANNOUNCEMENT FROM THE DATABASE
if(isset($_POST["announcementID"])){
	// $inboxQuery = "SELECT a.announcement_id, a.announcement_image, a.announcement, a.date_time, b.customerID  FROM `announcement a, customers b`";
	$inboxQuery = "SELECT * FROM announcement";
	$run_query = mysqli_query($con,$inboxQuery);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$announcement_id = $row['announcement_id'];
			$announcement_image = $row['announcement_image'];
			$announcement   = $row['announcement'];
			// START DATE
			$date_time1 = $row['date_time'];
			$start_date = date('F d, Y',strtotime($date_time1));
			
			// END DATE
			$date_time2 = $row['valid_until'];
			$end_date = date('F d, Y',strtotime($date_time2));

			echo "
			<div class='my-4' style='max-width: 100%;'>
				<div class='row g-0'>
					<div class='col-md-5'>
						<img src='/TNAN/admin/assets/announcementPhoto/$announcement_image' height='100%' width='100%'>
					</div>
					<div class='col-md-7'>
					<div class='card-body'>
						<p class='card-text'><small class='text-muted'>Valid until: $end_date</small></p>
						<h5 class='card-title'>Dear Valued Customer,</h5>
						<p class='card-text text-secondary'>$announcement</p>
						<p class='card-text'><small class='text-muted'>Posted On: $start_date</small></p>
					</div>
				</div>
			</div> 
			";
		}
	}else{
		echo "
		<div class='my-5'>
				<h5 class='text-center'>NO NEW ANNOUNCEMENT FOR NOW</h5>
		</div>   
		";
	}
}

// FUNCTION FOR REMOVE ANNOUNCEMENT
if(isset($_POST['removeAnnouncementID'])){
    $sql = "SELECT * FROM `announcement`";
	$result = mysqli_query($con,$sql) or die($con->error);
	if(mysqli_num_rows($result)>0){
	while($row = mysqli_fetch_array($result)){
        // CURRENT DATE FROM MANILA
		date_default_timezone_set("asia/manila");
		$currentdate = date("F d, Y");
		// VALID UNTIL / DATE EXPIRATION
		$announcement_id  = $row['announcement_id'];
		$valid_until  = $row['valid_until'];
		$end_date = date('F d, Y',strtotime($valid_until));
        if($currentdate == $end_date){
           $sql2 = "DELETE FROM `announcement` WHERE `announcement_id` = '$announcement_id'";  
           $result2 = mysqli_query($con,$sql2) or die($con->error);
           if($result2){
               echo 1;
           }
        }
    }
	}	
}

// FETCH CUSTOMER DETAILS
if(isset($_POST['customerDetails'])){
	$sql = "SELECT `customerID` FROM `customers` WHERE `customerID` = '$_SESSION[uid]'";
	$result = mysqli_query($con,$sql);
	$customerArray = array();
	if(mysqli_num_rows($result) > 0){
		while($rows = mysqli_fetch_array($result)){
			array_push($customerArray, $rows);
		}
	}
	echo json_encode($customerArray);
}

// FUNCTION FETCH PURCHASE HISTORY FROM THE DATABASE
if(isset($_POST["purchaseHistory"])){
	error_reporting(0);
	$received = "Received";
	$sql = "SELECT a.order_id, a.product, a.product_price, a.quantity, b.order_id, b.user_id, b.payment_option, b.date_time_bought,	b.order_status FROM user_orders a, order_manager b WHERE b.order_status = '$received' AND a.order_id = b.order_id AND b.user_id = $_SESSION[uid]";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$order_status = $row['order_status'];
			$order_id = $row['order_id'];
			$product = $row['product'];
			$product_price = $row['product_price']; 	
			$quantity = $row['quantity'];
			$payment_option = $row['payment_option'];
			$date_time_bought = $row['date_time_bought'];
			$newDate = date('F d, Y || h:i:A',strtotime($date_time_bought));
			$n++;
			echo "
			<div class='card mt-3'>
			<div class='card-body text-start'>
					<div class='row'>
						<div class='col-6'>
							<h6 class='card-title text-dark'>$n.</h6>
						</div>
					</div>
					<h6 class='card-title'>Price: ₱$product_price.00</h6>
					<h6 class='card-title text-secondary'>Quantity: X$quantity</h6>
					<h6 class='card-title text-secondary my-2'>Product: $product</h6>
					<h6 class='card-title text-secondary '>Payment Option: $payment_option</h6>
					<h6 class='card-title text-secondary'>Date Bought By: $newDate</h6>
				</div>
			</div>         
			";
		}
	}else{
		echo "
		<div class='row text-center'>
			<div class='col-md-12 py-3 mt-5'><h5>NO PURCHASE HISTORY</h5></div>
		</div>
		<div class='row text-center'>
			<div class='col-md-12 mb-5'><a class='btn btn-danger btn-sm' href='/TNAN/shop.php'>Go Order Now</a></div>
		</div>
		";
	}
}	

// FUNCTION FETCH PENDING PRODUCT FROM THE DATABASE
if(isset($_POST["pendingID"])){
		$Deliver = 'Deliver';
		$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.order_status, b.order_id, b.product, b.product_price, b.quantity, b.total, b.date_time_bought, c.customerID, c.customerName FROM order_manager a , user_orders b , customers c WHERE a.order_status = '$Deliver' AND a.order_id = b.order_id AND a.user_id = c.customerID AND a.user_id = '$_SESSION[uid]'";
		$run_query = mysqli_query($con,$product_query);
		if(mysqli_num_rows($run_query) > 0){
			while($row = mysqli_fetch_array($run_query)){	
				$order_id   = $row['order_id'];
				$customerName = $row['customerName'];
				$payment_option = $row['payment_option'];
				$product = $row['product'];
				$quantity = $row['quantity'];
				$total_amount = $row['total_amount'];
				$date_time_bought = $row['date_time_bought'];
				$new_date = date('F d, Y | h:i A',strtotime($date_time_bought));
				echo "
				<div class='col-4 mb-4'>
					<div class='card'>
						<div class='card-header bg-white'>
							<p class='card-text'style='text-transform:Uppercase; font-size:14px;'>$new_date</p>
						</div>
						<div class='card-body'>
							<h5 style='font-size:16px;' class='card-title fw-bold' style='text-transform:Uppercase;'><i class='fas fa-truck'></i> TO DELIVER</h5>
							<p style='font-size:15px;' class='card-text'>QUANTITY: X$quantity</p>
							<p style='font-size:15px;' class='card-text'>PRODUCT: $product</p>
							<p style='font-size:15px;' class='card-text'>TOTAL: ₱$total_amount.00</p>
							<p style='font-size:15px;' class='card-text text-secodary' style='text-transform:Uppercase;'>$payment_option</p>
						</div>
							<button style='border:none; font-size:15px;' onclick=received('$order_id') class='btn btn-sm btn-danger p-2'>RECEIVE ORDER </button>
					</div>
				</div>
				";
			}
		}else{
			echo'
				<div class"container">
					<div class="row my-5 ">
							<H5 class="text-center"> NO PENDING ORDERS FOR NOW</H5>
					</div>
				</div>
			';
		}
}

// FUNCTION FOR RECEIVE ORDERS
if(isset($_POST["received"])) {
	$received = $_POST["received"];
	$success = "Received";
	$sql = "UPDATE `order_manager` SET `order_status` = '$success' WHERE `order_id` = '$received'";
	$result= mysqli_query($con,$sql);
	if($result){
		echo 1;
		exit();
	}else{
		echo 0;
		exit();
	}
}
?>