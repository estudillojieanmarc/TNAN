<?php
include('config.php');

// ORDER
if(isset($_POST["getOrder"])){
	$limit = 12;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$Order = 'Order';
	$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.order_status, b.order_id, b.product, b.product_price, b.quantity, b.total, b.date_time_bought, c.customerID, c.customerName FROM order_manager a , user_orders b , customers c WHERE a.order_status = '$Order' AND a.order_id = b.order_id AND a.user_id = c.customerID";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){	
			$order_id   = $row['order_id'];
			$customerName = $row['customerName'];
			$payment_option = $row['payment_option'];
			$product = $row['product'];
			$quantity = $row['quantity'];
			$total_amount = $row['total_amount'];
			$total = $row['total'];
			$date_time_bought = $row['date_time_bought'];
			$new_date = date('F d, Y || h:i:A',strtotime($date_time_bought));
			echo "
			<div class='col-3 mb-4'>
            	<div class='card' style='width: 18rem;'>
					<div class='card-header bg-white'>
						<p class='card-text text-secondary' style='text-transform:Uppercase;'>$new_date</p>
					</div>
            	<div class='card-body'>
					<h5 class='card-title fw-bold my-3' style='text-transform:Uppercase;'>$customerName</h5>
					<p class='card-text'>QUANTITY: X$quantity</p>
					<p class='card-text'>PRODUCT: $product</p>
					<p class='card-text'>TOTAL: ₱$total_amount.00</p>
					<p class='card-text text-secodary' style='text-transform:Uppercase;'>$payment_option</p>
				</div>
					<button style='border:none; font-size:15px;' onclick=marked('$order_id') class='btn btn-sm btn-outline-primary ms-auto p-2'>PREPARE NOW <i class='fas fa-arrow-right'></i></button>
				</div>
        	</div> 
			";
		}
	}else{
		echo'
			<div class"container">
				<div class="row my-5 py-5">
					<div class="col-12 my-5 py-5">
						<H3 class="text-center fw-bold">NO ORDER YET</H3>
					</div>
				</div>
			</div>
		';
	}
// PAGE LIMIT FUNCTION
if(isset($_POST["page"])){
	$sql = "SELECT * FROM user_orders";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/12);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li class='nav-item mx-1 '><a style='list-style:none; ' class='btn btn-sm btn-outline-secondary px-3' page='$i' id='page'>$i</a></li>
		";
	}
}
}


// PREPARE
if(isset($_POST["getPrepare"])){
	$limit = 12;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$Preparing = 'Preparing';
	$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.order_status, b.order_id, b.product, b.product_price, b.quantity, b.total, b.date_time_bought, c.customerID, c.customerName FROM order_manager a , user_orders b , customers c WHERE a.order_status = '$Preparing' AND a.order_id = b.order_id AND a.user_id = c.customerID";
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
			$new_date = date('F d, Y || h:i:A',strtotime($date_time_bought));
			echo "
			<div class='col-3 mb-4'>
            	<div class='card' style='width: 18rem;'>
					<div class='card-header bg-white'>
						<p class='card-text text-secondary' style='text-transform:Uppercase;'>$new_date</p>
					</div>
            	<div class='card-body'>
					<h5 class='card-title fw-bold my-3' style='text-transform:Uppercase;'>$customerName</h5>
					<p class='card-text'>QUANTITY: X$quantity</p>
					<p class='card-text'>PRODUCT: $product</p>
					<p class='card-text'>TOTAL: ₱$total_amount.00</p>
					<p class='card-text text-secodary' style='text-transform:Uppercase;'>$payment_option</p>
				</div>
					<button style='border:none; font-size:15px;' onclick=deliver('$order_id') class='btn btn-sm btn-outline-primary ms-auto p-2'>DELIVER NOW <i class='fas fa-arrow-right'></i></button>
				</div>
        	</div> 
						";
		}
	}else{
		echo'
			<div class"container">
				<div class="row my-5 py-5">
					<div class="col-12 my-5 py-5">
						<H3 class="text-center fw-bold"> NO PREPARING FOR NOW  </H3>
					</div>
				</div>
			</div>
		';
	}
// PAGE LIMIT FUNCTION
if(isset($_POST["page"])){
	$sql = "SELECT * FROM user_orders";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/12);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li class='nav-item mx-1 '><a style='list-style:none; ' class='btn btn-sm btn-outline-secondary px-3' page='$i' id='page'>$i</a></li>
		";
	}
}
}

// DELIVER
if(isset($_POST["getDeliver"])){
	$limit = 12;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$Deliver = 'Deliver';
	$product_query = "SELECT a.order_id, a.total_amount, a.user_id, a.payment_option, a.order_status, b.order_id, b.product, b.product_price, b.quantity, b.total, b.date_time_bought, c.customerID, c.customerName FROM order_manager a , user_orders b , customers c WHERE a.order_status = '$Deliver' AND a.order_id = b.order_id AND a.user_id = c.customerID";
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
			$new_date = date('F d, Y || h:i:A',strtotime($date_time_bought));
			echo "
			<div class='col-3 mb-4'>
			<div class='card' style='width: 18rem;'>
				<div class='card-header bg-white'>
					<p class='card-text text-secondary' style='text-transform:Uppercase;'>$new_date</p>
				</div>
			<div class='card-body'>
				<h5 class='card-title fw-bold my-3' style='text-transform:Uppercase;'>$customerName</h5>
				<p class='card-text'>QUANTITY: X$quantity</p>
				<p class='card-text'>PRODUCT: $product</p>
				<p class='card-text'>TOTAL: ₱$total_amount.00</p>
				<p class='card-text text-secodary' style='text-transform:Uppercase;'>$payment_option</p>
			</div>
				<p class='card-text text-center mt-3 bg-primary py-1 text-white'>WAIT FOR THE RESPONSE</p>
			</div>
			</div> 
			";
		}
	}else{
		echo'
			<div class"container">
				<div class="row my-5 py-5">
					<div class="col-12 my-5 py-5">
						<H3 class="text-center fw-bold"> ALL PRODUCT HAS BEEN DELIVER</H3>
					</div>
				</div>
			</div>
		';
	}
// PAGE LIMIT FUNCTION
if(isset($_POST["page"])){
	$sql = "SELECT * FROM user_orders";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/12);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li class='nav-item mx-1 '><a style='list-style:none; ' class='btn btn-sm btn-outline-secondary px-3' page='$i' id='page'>$i</a></li>
		";
	}
}
}


// RECEIVE
if(isset($_POST["getReceived"])){
	$limit = 12;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$Received = 'Received';
	$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.order_status, b.order_id, b.product, b.product_price, b.quantity, b.total, b.date_time_bought, c.customerID, c.customerName FROM order_manager a , user_orders b , customers c WHERE a.order_status = '$Received' AND a.order_id = b.order_id AND a.user_id = c.customerID";
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
			$new_date = date('F d, Y || h:i:a',strtotime($date_time_bought));
			echo "
			<div class='col-3 mb-4'>
            <div class='card' style='width: 18rem;'>
			<div class='card-header bg-white'>
				<p class='card-text text-secondary' style='text-transform:Uppercase;'>$new_date</p>
			</div>
            <div class='card-body bg-white text-dark'>
                <h5 class='card-title fw-bold my-3' style='text-transform:Uppercase;'>$customerName</h5>
                <p class='card-text'>PRODUCT: x$quantity of $product</p>
                <p class='card-text'>TOTAL: ₱$total_amount.00</p>
                <p class='card-text text-secodary' style='text-transform:Uppercase;'>$payment_option</p>
			</div>
				<button onclick=complete('$order_id') class='btn btn-sm btn-primary p-2'>COMPLETED</button>
            </div>
            </div>
			";
		}
	}else{
		echo'
			<div class"container">
				<div class="row my-5 py-5">
					<div class="col-12 my-5 py-5">
						<H3 class="text-center fw-bold"> ALL PRODUCT HAS BEEN DELIVER </H3>
					</div>
				</div>
			</div>
		';
	}
// PAGE LIMIT FUNCTION
if(isset($_POST["page"])){
	$sql = "SELECT * FROM user_orders";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/12);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li class='nav-item mx-1 '><a style='list-style:none; ' class='btn btn-sm btn-outline-secondary px-3' page='$i' id='page'>$i</a></li>
		";
	}
}
}


// COMPLETE
if(isset($_POST['getCompleted'])){
	$Complete = 'Complete';
	$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.order_status, b.order_id, b.product, b.product_price, b.quantity, b.total, b.date_time_bought, c.customerID, c.customerName FROM order_manager a , user_orders b , customers c WHERE a.order_status = '$Complete' AND a.order_id = b.order_id AND a.user_id = c.customerID LIMIT 6";
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
			$new_date = date('F d, Y || h:i:a',strtotime($date_time_bought));
			echo "
			<tr>
				<td>$order_id</td>
				<td>$customerName</td>
				<td>$total_amount</td>
				<td>$new_date</td>
				<td>$payment_option</td>
			</tr>
			";
		}
	}else {
		echo "
				<tr>
					<td></td>
					<td></td>
					<td>NO DATA FOUND</td>
					<td></td>
					<td></td>
				</tr>
		";
	}
}
?>