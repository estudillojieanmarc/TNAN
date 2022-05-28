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
				<img alt='image of users' style='clip-path:circle(); height:25px; width:25px; margin:-4px 7px 0 0' src='/TNAN/admin/assets/customersPhoto/$customerImage'><span>$customerName</span>
				";
		}
	}
}

// FETCH CATEGORY
if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills nav-stacked col-1'>
		<ul>
		<li class='nav-item'><a class='nav-link text-dark' style='letter-spacing:1px;' href='/TNAN/shop.php'>•All</a></li>
		";
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["categories_ID"];
			$cat_name = $row["categories"];
			echo "
                <li class='nav-item d-flex'><a class='nav-link category text-dark' style='letter-spacing:1px; justify-content:center;' href='#' cid='$cid'>•$cat_name</a></li>
			";
		}
		echo "
		</ul>
		</div>";
	}
}

// PAGE LIMIT FUNCTION
if(isset($_POST["page"])){
	$sql = "SELECT * FROM food WHERE foodStock > 0 AND foodStatus = 0";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/12);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li class='nav-item mx-1 d-flex'><a class='btn btn-sm px-3 text-white d-flex ' style='background-color: #826F66 !important; cursor:pointer;' href='#' page='$i' id='page'>$i</a></li>
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
	$product_query = "SELECT * FROM food WHERE foodStatus = 0 AND foodStock > 0 LIMIT $start,$limit ";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$foodID     = $row['foodID'];
			$foodImage   = $row['foodImage'];
			$foodName = $row['foodName'];
			$foodCategory = $row['foodCategory'];
			$foodDescription = $row['foodDescription'];
			$foodPrice = $row['foodPrice'];
			$foodStock = $row['foodStock'];
			echo "
			<div class='col-3 py-2'>
				<div class='card'>
					<div style='font-weight:500; background-color:transparent;' class='card-header px-3 pt-2'>
						$foodName
					</div>
					<div class='card-body'>
						<img class='card-img-top' src='/TNAN/admin/assets/foodPhoto/$foodImage' style='width:220px; height:200px;'/>
						<p class='card-text text-dark py-2' style='font-size:14px;'>$foodDescription</p>
						<div class='row'>
							<div class='col-6'><italic class='text-secondary' style='font-size:18px;'>₱$foodPrice.00</italic></div>
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
				<div class='card'>
					<div style='font-weight:500; background-color:transparent;' class='card-header px-3 pt-2'>
						$foodName
					</div>
					<div class='card-body'>
						<img class='card-img-top' src='/TNAN/admin/assets/foodPhoto/$foodImage' style='width:220px; height:200px;'/>
						<p class='card-text text-dark py-2' style='font-size:14px;'>$foodDescription</p>
						<div class='row'>
							<div class='col-6'><italic class='text-secondary' style='font-size:18px;'>₱$foodPrice.00</italic></div>
						</div>
					</div>
					<button pid='$foodID' id='addCart' style='font-size:13px;' class='btn text-white '><i class='fas fa-cart-plus'></i> Add to cart</button>
				</div>
		    </div>	
		";
		}
	}else{
		echo "
			<div class='alert bg-light text-center' style='color:#AD8B73;' role='alert'><h5>No available product</h5></div>
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

// FUNCTION FOR ADDING QTY IN PENDING BADGE
if (isset($_POST["count_pending"])) {
	if (isset($_SESSION["uid"])) {
		$deliver = "Deliver";
		$sql = "SELECT COUNT(*) AS count_pending FROM order_manager WHERE order_status != 'Complete' AND order_status != 'Cancel' AND order_status != 'Received' AND `user_id` = '$_SESSION[uid]'";
	}
	$query = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_pending"];
	exit();
}

// FUNCTION FOR DISPLAY THE CART DETAILS IN MODAL
if (isset($_POST["Common"])) {
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT a.foodID,a.foodImage,a.foodStock,a.foodDescription,a.foodPrice,b.id,b.qty FROM food a,cart b WHERE a.foodID = b.p_id AND b.user_id = '$_SESSION[uid]'";
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
							<th>Stock</th>
							<th>Qty</th>
							<th>Total</th>
							<th><button type="button" class="btn btn-sm removeAll text-white" style="background-color: #826F66 !important">Clear Cart</button></th>
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
				$foodStock = $row["foodStock"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<tbody class="text-center" style="font-size:14.5px;">
						<tr>
							<input type="hidden" name="foodID[]" id="foodID" value='.$foodID.'>
							<input type="hidden" class="totalH" name="total[]">
							<td class="col-0 fw-bold">'.$n.'.</td>
							<td class="col-2"><img class="img-responsive img-thumbnail" style="height:100px; width:100px;" src="/TNAN/admin/assets/foodPhoto/'.$foodImage.'"/></td>
							<td class="col-2 foodDescription">'.$foodDescription.'</td>
							<td class="col-2 foodPrice">₱'.$foodPrice.'.00<input class="price" type="hidden" value='.$foodPrice.'></td>
							<td class="col-1 foodStock">'.$foodStock.'<input class="stock" type="hidden" value='.$foodStock.'></td>
							<td class="col-2"><input class="form-control form-control-sm text-center quantity mx-auto" name="quantity[]" type="number" min="1" value='.$qty.' onchange="net_total()" style="width:3.5rem;"></td>
							<td class="col-1 fw-bold text-center">₱<span class="total"></span>.00</td>
							<td class="col-2">
							<button remove_id="'.$foodID.'" class="btn remove" style="border-color: #826F66 !important; color:#826F66" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove item?"><i class="fas fa-trash-alt"></i></button> 
							<button update_id="'.$foodID.'" class="btn update" style="border-color: #826F66 !important; color:#826F66" data-bs-toggle="tooltip" data-bs-placement="top" title="Save Changes?"><i class="fas fa-check-circle"></i></button>
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
								<span style="font-size:19px;" class="text-dark px-4 fw-bold">₱<span name="total_amount" id="total_amount"></span>.00</span>
							</div>
						</div>
						<div class="form-check mt-2">
						<input class="form-check-input paymentOption" value="Cash On Delivery" type="radio" name="payment_option" checked>
						<label class="form-check-label">
							Cash On Delivery
						</label>
						</div>
						<div class="form-check">
						<input class="form-check-input paymentOption" value="G-Cash" type="radio" name="payment_option" disabled>
						<label class="form-check-label">
							G-Cash
						</label>
						</div>
						<div class="row mt-3">
							<button type="button" id="checkoutBtn" style="background-color: #826F66 !important;" class="btn btn-sm text-white"> <i class="fab fa-paypal"></i> CHECKOUT NOW </button>
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
						<div class="col-md-12 mb-5"><a style="background-color: #826F66 !important;" class="btn btn-sm text-white" href="/TNAN/shop.php">Go Order Now</a></div>
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
	$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.order_status, c.customerID, 
	c.customerName FROM order_manager a , customers c WHERE a.order_status = 'complete' AND a.user_id = '$_SESSION[uid]' AND c.customerID = '$_SESSION[uid]' AND a.user_id =  c.customerID
	OR a.order_status = 'Received' AND a.user_id = '$_SESSION[uid]' AND c.customerID = '$_SESSION[uid]' AND a.user_id =  c.customerID ORDER BY a.order_id DESC";
		$result = mysqli_query($con,$product_query);
		if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			    $order_id   = $row['order_id'];
				$customerName = $row['customerName'];
				$order_status = $row['order_status'];
				$payment_option = $row['payment_option'];
				$total_amount = $row['total_amount'];
				$grandtotal = $total_amount + 50;
				echo "
				<div class='col-12 mt-2 mb-4'>		
					<div class='card'>
							<div class='card-body'>
					";
						$order_query = "SELECT a.order_id , a.product, a.quantity, a.total, b.foodID, b.foodName 
						FROM user_orders a INNER JOIN food b ON a.product = b.foodID WHERE order_id = '$row[order_id]'";
						$runs_query = mysqli_query($con,$order_query); 
						echo "
						<p class='card-title fw-bold pt-2'>Order:</p>
						";
						while($order_result = mysqli_fetch_array($runs_query))
						{				
						$quantity = $order_result['quantity'];
						$product  = $order_result['foodName'];
						$total  = $order_result['total'];
						echo"
						<p class='card-title'>⁃ x$quantity of $product total of: ₱$total.00</p>";
						}
						echo"
							<p class='card-title fw-bold pt-2'>Payment:</p>
							<p class='card-title'>Option: $payment_option</p>
							<p class='card-title'>Fee: ₱$total_amount.00 + Delivery Fee ₱50.00</p>
							<p class='card-title'>Total Amount: <span class='fw-bold text-danger'>₱$grandtotal.00</span></p>
						</div>
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
			<div class='col-md-12 mb-5'><a style='background-color: #826F66 !important;' class='btn text-white btn-sm' href='/TNAN/shop.php'>Go Order Now</a></div>
		</div>
		";
	}
}	

// FUNCTION FETCH PENDING PRODUCT FROM THE DATABASE
if(isset($_POST["pendingID"])){
		$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.order_status, c.customerID, c.customerName
		FROM order_manager a , customers c WHERE a.order_status != 'Complete' AND a.order_status != 'Received'
		AND a.order_status != 'Cancel' AND a.user_id = '$_SESSION[uid]' AND  c.customerID = '$_SESSION[uid]' 
		AND a.user_id =  c.customerID";
		$run_query = mysqli_query($con,$product_query);
		if(mysqli_num_rows($run_query) > 0){
			while($row = mysqli_fetch_array($run_query)){	
				$order_id   = $row['order_id'];
				$customerName = $row['customerName'];
				$order_status = $row['order_status'];
				$payment_option = $row['payment_option'];
				$total_amount = $row['total_amount'];
				$grandtotal = $total_amount + 50;
				if($row['order_status'] == 'To Deliver'){
				echo "
				<div class='col-4 mb-4'>		
					<div class='card'>
						<div class='card-header' style='background-color:#826F66;'>
							<p class='card-text text-white py-2 text-center'>ORDERED DETAILS</p>
							</div>
							<div class='card-body'>
							<p class='card-title fw-bold'>Status:<span class='text-primary'> $order_status</span></p>
							<p class='card-title fw-bold pt-2'>Order:</p>
					";
						$order_query = "SELECT a.order_id , a.product, a.quantity, a.total, b.foodID, b.foodName 
						FROM user_orders a INNER JOIN food b ON a.product = b.foodID WHERE order_id = '$row[order_id]'";
						$runs_query = mysqli_query($con,$order_query); 
						while($order_result = mysqli_fetch_array($runs_query))
						{				
						$quantity = $order_result['quantity'];
						$product  = $order_result['foodName'];
						$total  = $order_result['total'];
						echo"
						<p class='card-title'>⁃ x$quantity of $product total of: ₱$total.00</p>";
						}
						echo"
							<p class='card-title fw-bold pt-2'>Payment:</p>
							<p class='card-title'>Option: $payment_option</p>
							<p class='card-title'>Fee: ₱$total_amount.00 + Delivery Fee ₱50.00</p>
							<p class='card-title'>Total Amount: <span class='fw-bold text-danger'>₱$grandtotal.00</span></p>
						</div>
						<button style='background-color:#826F66; cursor:pointer;' font-size:15px;' onclick=received('$order_id') class='btn btn-sm text-white py-3'>RECEIVE ORDER </button>					</div>
				</div> 
				</div> 
						";
				}else if($row['order_status'] == 'Order'){
				echo "
					<div class='col-4 mb-4'>		
					<div class='card'>
						<div class='card-header' style='background-color:#826F66;'>
							<p class='card-text text-white py-2 text-center'>ORDERED DETAILS</p>
							</div>
							<div class='card-body'>
							<p class='card-title fw-bold'>Status:<span class='text-danger'> Pending $order_status</span></p>
							<p class='card-title fw-bold pt-2'>Order:</p>
					";
						$order_query = "SELECT a.order_id , a.product, a.quantity, a.total, b.foodID, b.foodName 
						FROM user_orders a INNER JOIN food b ON a.product = b.foodID WHERE order_id = '$row[order_id]'";
						$runs_query = mysqli_query($con,$order_query); 
						while($order_result = mysqli_fetch_array($runs_query))
						{				
						$quantity = $order_result['quantity'];
						$product  = $order_result['foodName'];
						$total  = $order_result['total'];
						echo"<p class='card-title'>⁃ x$quantity of $product total of: ₱$total.00</p>";
						}
						echo"
							<p class='card-title fw-bold pt-2'>Payment:</p>
							<p class='card-title'>Option: $payment_option</p>
							<p class='card-title'>Fee: ₱$total_amount.00 + Delivery Fee ₱50.00</p>
							<p class='card-title'>Total Amount: <span class='fw-bold text-danger'>₱$grandtotal.00</span></p>
						</div>
						<button style='background-color:#826F66; cursor:pointer;' font-size:15px;' onclick=cancel('$order_id') class='btn btn-sm text-white py-3'>CANCEL ORDER</button>
				</div> 
				</div> 
						";
				}else{
					echo "
					<div class='col-4 mb-4'>		
					<div class='card'>
						<div class='card-header' style='background-color:#826F66;'>
							<p class='card-text text-white py-2 text-center'>ORDERED DETAILS</p>
							</div>
							<div class='card-body'>
							<p class='card-title fw-bold'>Status:<span class='text-primary'> $order_status</span></p>
							<p class='card-title fw-bold pt-2'>Order:</p>
					";
						$order_query = "SELECT a.order_id , a.product, a.quantity, a.total, b.foodID, b.foodName 
						FROM user_orders a INNER JOIN food b ON a.product = b.foodID WHERE order_id = '$row[order_id]'";
						$runs_query = mysqli_query($con,$order_query); 
						while($order_result = mysqli_fetch_array($runs_query))
						{				
						$quantity = $order_result['quantity'];
						$product  = $order_result['foodName'];
						$total  = $order_result['total'];
						echo"<p class='card-title'>x$quantity of $product total of: ₱$total.00</p>";
						}
						echo"
							<p class='card-title fw-bold pt-2'>Payment:</p>
							<p class='card-title'>Option: $payment_option</p>
							<p class='card-title'>Fee: ₱$total_amount.00 + Delivery Fee ₱50.00</p>
							<p class='card-title'>Total Amount: <span class='fw-bold text-danger'>₱$grandtotal.00</span></p>
						</div>
						<button disabled  style='background-color:#826F66; cursor:pointer;' font-size:15px;' onclick=received('$order_id') class='btn btn-sm text-white py-3'>CANCEL ORDER </button>				
						</div>
					</div> 
						";
				}
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
	$sql = "UPDATE `order_manager` SET `date_time_bought` = CURRENT_TIMESTAMP, `order_status` = '$success' WHERE `order_id` = '$received'";
	$result= mysqli_query($con,$sql);
	if($result){
		echo 1;
		exit();
	}else{
		echo 0;
		exit();
	}
}

// FUNCTION FOR RECEIVE ORDERS
if(isset($_POST["cancel"])) {
	$cancel = $_POST["cancel"];
	$Cancel = "Cancel";
	$sql = "UPDATE `order_manager` SET `order_status` = '$Cancel' WHERE `order_id` = '$cancel'";
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
