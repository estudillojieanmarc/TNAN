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
		$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.date_time_bought, a.order_status,
		b.customerID, b.customerName, b.customerContact, b.customerAddress FROM order_manager a 
		INNER JOIN customers b ON a.user_id = b.customerID
		WHERE a.order_status = 'order' ";
		$run_query = mysqli_query($con,$product_query); 
		if(mysqli_num_rows($run_query) > 0){
			while($row = mysqli_fetch_array($run_query)){	
				$order_id   = $row['order_id'];
				$customerName = $row['customerName'];
				$customerAddress = $row['customerAddress'];
				$customerContact = $row['customerContact'];
				$payment_option = $row['payment_option'];
				$total_amount = $row['total_amount'];
				$deliveryFee = $total_amount + 50;
				$date_time_bought = $row['date_time_bought'];
				$new_date = date('F d, Y || h:i:A',strtotime($date_time_bought));
				echo "
				<div class='col-4 mb-4'>		
					<div class='card text-center'>
						<div class='card-header text-center' style='background-color:#826F66;'>
							<p class='card-text text-white py-2'>ORDERED DETAILS</p>
							</div>
							<div class='card-body' style='line-height:15px;'>
							<h5 class='card-title fw-bold'>STATUS</h5>
							<p class='card-title text-danger'>PENDING ORDER</p>
							<h5 class='card-title fw-bold pt-3'>CUSTOMER DETAILS</h5>
							<p class='card-title'>Name: $customerName</p>
							<p class='card-title'>Contact: $customerContact</p>
							<p class='card-title'>Address: $customerAddress</p>	
							<p class='card-title'>Ordered On: $new_date</p>
							<h5 class='card-title fw-bold pt-3'>CUSTOMER ORDER</h5>									
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
							<p class='card-title'>Fee: ₱$total_amount.00 + Delivery Fee ₱50.00</p>
							<p class='card-title'>Total Amount: <span class='fw-bold text-danger'>₱$deliveryFee.00</span></p>
							<p class='card-title'>Option: $payment_option</p>
						</div>
						<button onclick=marked('$order_id') style='background-color:#826F66;' class='btn btn-sm text-white py-3 mt-3'>PREPARE NOW <i class='fas fa-arrow-right'></i></button>
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
// ORDER

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
		$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.date_time_bought, a.order_status,
		b.customerID, b.customerName, b.customerContact, b.customerAddress FROM order_manager a 
		INNER JOIN customers b ON a.user_id = b.customerID
		WHERE a.order_status = 'Preparing' ";
		$run_query = mysqli_query($con,$product_query); 
		if(mysqli_num_rows($run_query) > 0){
			while($row = mysqli_fetch_array($run_query)){	
				$order_id   = $row['order_id'];
				$customerName = $row['customerName'];
				$customerAddress = $row['customerAddress'];
				$customerContact = $row['customerContact'];
				$payment_option = $row['payment_option'];
				$total_amount = $row['total_amount'];
				$deliveryFee = $total_amount + 50;
				$date_time_bought = $row['date_time_bought'];
				$new_date = date('F d, Y || h:i:A',strtotime($date_time_bought));
				echo "
				<div class='col-4 mb-4'>		
					<div class='card text-center'>
						<div class='card-header text-center' style='background-color:#826F66;'>
							<p class='card-text text-white py-2'>ORDERED DETAILS</p>
							</div>
							<div class='card-body' style='line-height:15px;'>
							<h5 class='card-title fw-bold'>STATUS</h5>
							<p class='card-title text-primary'>PREPARING</p>
							<h5 class='card-title fw-bold pt-3'>CUSTOMER DETAILS</h5>
							<p class='card-title'>Name: $customerName</p>
							<p class='card-title'>Contact: $customerContact</p>
							<p class='card-title'>Address: $customerAddress</p>	
							<p class='card-title'>Ordered On: $new_date</p>
							<h5 class='card-title fw-bold pt-3'>CUSTOMER ORDER</h5>									
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
							<p class='card-title'>Fee: ₱$total_amount.00 + Delivery Fee ₱50.00</p>
							<p class='card-title'>Total Amount: <span class='fw-bold text-danger'>₱$deliveryFee.00</span></p>
							<p class='card-title'>Option: $payment_option</p>
						</div>
						<button onclick=deliver('$order_id') style='background-color:#826F66; cursor:pointer;' class='btn btn-sm text-white py-3 mt-3'>DELIVER NOW <i class='fas fa-arrow-right'></i></button>
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
// PREPARE

// DELIVER
	if(isset($_POST["getDeliver"])){
		$limit = 12;
		if(isset($_POST["setPage"])){
			$pageno = $_POST["pageNumber"];
			$start = ($pageno * $limit) - $limit;
		}else{
			$start = 0;
		}
		$Deliver = 'To Deliver';
		$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.date_time_bought, a.order_status,
		b.customerID, b.customerName, b.customerContact, b.customerAddress FROM order_manager a 
		INNER JOIN customers b ON a.user_id = b.customerID
		WHERE a.order_status = 'To Deliver' ";
		$run_query = mysqli_query($con,$product_query); 
		if(mysqli_num_rows($run_query) > 0){
			while($row = mysqli_fetch_array($run_query)){	
				$order_id   = $row['order_id'];
				$customerName = $row['customerName'];
				$customerAddress = $row['customerAddress'];
				$customerContact = $row['customerContact'];
				$payment_option = $row['payment_option'];
				$total_amount = $row['total_amount'];
				$deliveryFee = $total_amount + 50;
				$date_time_bought = $row['date_time_bought'];
				$new_date = date('F d, Y || h:i:A',strtotime($date_time_bought));
				echo "
				<div class='col-4 mb-4'>		
					<div class='card text-center'>
						<div class='card-header text-center' style='background-color:#826F66;'>
							<p class='card-text text-white py-2'>ORDERED DETAILS</p>
							</div>
							<div class='card-body' style='line-height:15px;'>
							<h5 class='card-title fw-bold'>STATUS</h5>
							<p class='card-title text-primary'>TO DELIVER</p>
							<h5 class='card-title fw-bold pt-3'>CUSTOMER DETAILS</h5>
							<p class='card-title'>Name: $customerName</p>
							<p class='card-title'>Contact: $customerContact</p>
							<p class='card-title'>Address: $customerAddress</p>	
							<p class='card-title'>Ordered On: $new_date</p>
							<h5 class='card-title fw-bold pt-3'>CUSTOMER ORDER</h5>									
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
							<p class='card-title'>Fee: ₱$total_amount.00 + Delivery Fee ₱50.00</p>
							<p class='card-title'>Total Amount: <span class='fw-bold text-danger'>₱$deliveryFee.00</span></p>
							<p class='card-title'>Option: $payment_option</p>
						</div>
						<p class='card-text text-center mt-3 py-3 text-white' style='background-color:#826F66;'>WAIT FOR THE CONFIRMATION</p>
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
// DELIVER

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
		$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.date_time_bought, a.order_status,
		b.customerID, b.customerName, b.customerContact, b.customerAddress FROM order_manager a 
		INNER JOIN customers b ON a.user_id = b.customerID
		WHERE a.order_status = 'Received' ";
		$run_query = mysqli_query($con,$product_query); 
		if(mysqli_num_rows($run_query) > 0){
			while($row = mysqli_fetch_array($run_query)){	
				$order_id   = $row['order_id'];
				$customerName = $row['customerName'];
				$customerAddress = $row['customerAddress'];
				$customerContact = $row['customerContact'];
				$payment_option = $row['payment_option'];
				$total_amount = $row['total_amount'];
				$deliveryFee = $total_amount + 50;
				$date_time_bought = $row['date_time_bought'];
				$new_date = date('F d, Y || h:i:A',strtotime($date_time_bought));
				echo "
				<div class='col-4 mb-4'>		
					<div class='card text-center'>
						<div class='card-header text-center' style='background-color:#826F66;'>
							<p class='card-text text-white py-2'>ORDERED DETAILS</p>
							</div>
							<div class='card-body' style='line-height:15px;'>
							<h5 class='card-title fw-bold'>STATUS</h5>
							<p class='card-title text-success'>RECEIVED</p>
							<h5 class='card-title fw-bold pt-3'>CUSTOMER DETAILS</h5>
							<p class='card-title'>Name: $customerName</p>
							<p class='card-title'>Contact: $customerContact</p>
							<p class='card-title'>Address: $customerAddress</p>	
							<p class='card-title'>Ordered On: $new_date</p>
							<h5 class='card-title fw-bold pt-3'>CUSTOMER ORDER</h5>									
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
							<p class='card-title'>Fee: ₱$total_amount.00 + Delivery Fee ₱50.00</p>
							<p class='card-title'>Total Amount: <span class='fw-bold text-danger'>₱$deliveryFee.00</span></p>
							<p class='card-title'>Option: $payment_option</p>
						</div>
						<button onclick=complete('$order_id') style='background-color:#826F66; cursor:pointer;' class='text-white btn btn-sm py-3'>COMPLETED</button>					
					</div>
				</div> 
			";
			}
		}else{
			echo'
				<div class"container">
					<div class="row my-5 py-5">
						<div class="col-12 my-5 py-5">
							<H3 class="text-center fw-bold">ALL PRODUCT HAS BEEN RECEIVE </H3>
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

// COMPLETE
	if(isset($_POST['getCompleted'])){
		$Complete = 'Complete';
		$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.date_time_bought, a.order_status, c.customerID, c.customerName 
		FROM order_manager a , customers c WHERE a.order_status = '$Complete' AND a.user_id = c.customerID ORDER BY a.date_time_bought DESC LIMIT 6";
		$run_query = mysqli_query($con,$product_query);
		if(mysqli_num_rows($run_query) > 0){
			while($row = mysqli_fetch_array($run_query)){	
				$order_id   = $row['order_id'];
				$customerName = $row['customerName'];
				$payment_option = $row['payment_option'];
				$total_amount = $row['total_amount'];
				$grand_total = $total_amount + 50;
				$date_time_bought = $row['date_time_bought'];
				$new_date = date('F d, Y',strtotime($date_time_bought));
				echo "
				<tr>
					<td>$customerName</td>
					<td>$grand_total</td>
					<td>$new_date</td>
					<td>$payment_option</td>
					<td><button class='btn btn-sm btn-danger' type='button' onclick='deleteComplete($order_id)'>DELETE</button></td>
				</tr>
				";
			}
		}else {
			echo "
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>NO DATA FOUND</td>
						<td></td>
						<td></td>
					</tr>
			";
		}
	}
// COMPLETE

// CANCEL
	if(isset($_POST["getCancel"])){
		error_reporting(0);
		$Cancel = 'Cancel';
		$product_query = "SELECT a.order_id, a.user_id, a.total_amount, a.payment_option, a.order_status, b.order_id, b.product, b.quantity, b.total, b.date_time_bought, c.customerID, c.customerName , c.customerContact, c.customerAddress, d.foodID , d.foodName, d.foodDescription FROM order_manager a , user_orders b , customers c , food d
		WHERE a.order_status = '$Cancel' AND a.order_id = b.order_id AND a.user_id = c.customerID AND b.product = d.foodID";
		$run_query = mysqli_query($con,$product_query);
		if(mysqli_num_rows($run_query) > 0){
			while($row = mysqli_fetch_array($run_query)){
				$n++;	
				$order_id   = $row['order_id'];
				$customerName = $row['customerName'];
				$foodName = $row['foodName'];
				echo "
				<tr>
					<td>$n</td>
					<td>$foodName</td>
					<td>$customerName</td>
					<td><button class='btn btn-sm btn-danger' type='button' onclick='deleteCancel($order_id)'>DELETE</button></td>
				</tr>
				";
			}
		}else{
			echo'
				<tr>
					<td></td>
					<td>NO DATA FOUND</td>
					<td></td>
					<td></td>
				</tr>
			';
		}
	}
// CANCEL

?>