<?php
	 include 'Razorpay.php';

	 use Razorpay\Api\Api;
	 $api = new Api('rzp_test_Q74V3QfdCceNFV', 'goAWdAi2XuZodpGsvxmbB6GR');



	 //connect to the database
	$conn = mysqli_connect('localhost', 'Babli', '12345', 'biba');
	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	$name = $email = $phone = $street = $city = $postCode = $state = $date = $tableFor = $ocassions =$comments  = '';
	$errors = array('name' => '', 'email' => '', 'phone' => '', 'street' => '', 'city' => '', 'postCode' => '', 'state' => '', 'date' => '', 'tableFor' => '', 'ocassions' => '');
	
	if(isset($_POST['submit']) || isset($_POST['book'])){
		
		// check name
		if(empty($_POST['name'])){
			$errors['name'] = 'A name is required';
		} else{
			$name = $_POST['name'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				$errors['title'] = 'name must be letters and spaces only';
			}
		}

		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

		//check phone
			if(empty($_POST['phone'])){
			$errors['phone'] = 'A phone is required';
			} else{
			$phone = $_POST['phone'];
			if(!(ctype_digit($phone)) || !(strlen($phone) == 10)){
				$errors['phone'] = 'A valid phone number is required. eg. 9999999999';
			}
		}
		// check street
		if(empty($_POST['street'])){
			$errors['street'] = 'A street is required';
		} else{
			$street = $_POST['street'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $street)){
				$errors['street'] = 'Invalid Format';
			}
		}
		// check city
		if(empty($_POST['city'])){
			$errors['city'] = 'A city is required';
			} else{
			$city = $_POST['city'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $city)){
				$errors['city'] = 'city must be letters and spaces only';
			}
		}
		// check post code
		if(empty($_POST['postCode'])){
			$errors['postCode'] = 'A postCode is required';
			} else{
			$postCode = $_POST['postCode'];
			if(!(ctype_digit($postCode)) || !(strlen($postCode) == 6)){
				$errors['postCode'] = 'A valid postCode is required. eg. 781***';
			}
		}
		// check state
		if(empty($_POST['state'])){
			$errors['state'] = 'A state is state required';
			} else{
			$state = $_POST['state'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $state)){
				$errors['state'] = 'state must be letters and spaces only';
			}
		}

		// check date
			if(empty($_POST['date'])){
				$errors['date'] = 'A date is required';
			} else{
				$date = $_POST['date'];
			}
		// check tableFor
		if(empty($_POST['tableFor'])){
				$errors['tableFor'] = 'A table is required';
			} else{
				$tableFor = $_POST['tableFor'];
			}

		//check ocassions
		if(empty($_POST['ocassions'])){
			$errors['ocassions'] = 'an Ocassion is required';
		} else{
			$ocassions = $_POST['ocassions'];
		}
		// check comments
		if(!empty($_POST['comments'])){
			$comments = $_POST['comments'];
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$name = mysqli_real_escape_string($conn, ucwords($_POST['name']));
			$street = mysqli_real_escape_string($conn,ucwords($_POST['street']));
			$phone = mysqli_real_escape_string($conn, $_POST['phone']);
			$city = mysqli_real_escape_string($conn, $_POST['city']);
			$tableFor = mysqli_real_escape_string($conn, $_POST['tableFor']);
			$postCode = mysqli_real_escape_string($conn, $_POST['postCode']);
			$comments = mysqli_real_escape_string($conn, $_POST['comments']);
			$ocassions = mysqli_real_escape_string($conn, $_POST['ocassions']);
			$date = mysqli_real_escape_string($conn, $_POST['date']);
			$state = mysqli_real_escape_string($conn, $_POST['state']);
			$Id = md5($email).uniqid();
			 $price = 350000;
			
			// create sql
					$sql = "INSERT INTO reservation(Name, Email, Phone_number, Street, City, PostCode, State, rDate, Table_for, Ocassions, Other_requirements, cStatus, id, paymentid) VALUES('$name', '$email', '$phone', '$street', '$city', '$postCode', '$state', '$date', '$tableFor', '$ocassions', '$comments', 'Pending', '$Id', '')";

			
			if(isset($_POST['book'])){

				$order = $api->order->create(array('amount' => $price, 'currency' => 'INR')); 
				echo "<script>console.log($order->id)</script>";


					if(!empty($order)){
							echo "<script src='https://checkout.razorpay.com/v1/checkout.js'></script>
									<script>
										var options = {
    										'key': 'rzp_test_Q74V3QfdCceNFV', // Enter the Key ID generated from the Dashboard
    									'amount': '$price', 
    									'currency': 'INR',
    									'name': 'Kionion',
    									'description': '',
    									'image': 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcT2FwmyVgeSlIWe9vcMo7LJCmhjO9ioWf3NdTjY2p8Mp3YcP7EA',
    									'order_id': '$order',
    									'handler': function (response){
        								      alert(response.razorpay_payment_id);
   										 },
    									'prefill': {
    									    'name': '$name',
    									    'email': '$email',
    									    'contact': '$phone'
    									    },
   											'notes': {
    									    	'address': '$street',
   											 },
    										'theme': {
   										     	'color': '#F37254'
   										     }
    
										};
									var rzp1 = new Razorpay(options);
									function r(){
									    rzp1.open();
    									
									}
									r();
							</script>";
					}
			
				// create sql
					$sql = "INSERT INTO reservation(Name, Email, Phone_number, Street, City, PostCode, State, rDate, Table_for, Ocassions, Other_requirements, cStatus, id) VALUES('$name', '$email', '$phone', '$street', '$city', '$postCode', '$state', '$date', '$tableFor', '$ocassions', '$comments', 'Pending', '$Id')";

			}

			
			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('location: ../index.php');
				// echo ' <script type = "text/javascript"> alert("reservation form submitted successfully")</script>';
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
		}
	} // end POST check




?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/reservation.css">
	
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
	<script src="https://raw.githubusercontent.com/andiio/selectToAutocomplete/master/jquery-ui-autocomplete.js"></script>
	<script src="https://raw.githubusercontent.com/andiio/selectToAutocomplete/master/jquery.select-to-autocomplete.js"></script>
<!--RED COLOR
LEFT ALIGN 
BULLETS
-->	
<style>
	
	#error>ul{
		color: red;
		text-align: left;
  		list-style-type: circle;
  		padding-bottom: 15px;
  		padding-left: 15px;
}
</style>
	

</head>
<body>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<div id="error"><ul>
				<?php foreach ($errors as $key => $value):
							if(!empty($value)){

				 ?>
				<li><?php echo  $value; ?></li>
			<?php } ?>
				<?php endforeach; ?>
						</ul>
		</div>

  <!--  General -->
  <div class="form-group">
    <h2 class="heading">Booking & contact</h2>
    <div class="controls">
      <input type="text" id="name" class="floatLabel" name="name" >
      <label for="name">Name</label>
	    
    </div>
    <div class="controls">
      <input type="text" id="email" class="floatLabel" name="email" >
      <label for="email">Email</label>
    </div>       
    <div class="controls">
      <input type="text" id="phone" class="floatLabel" name="phone" >
      <label for="phone">Phone</label>
    </div>
      <div class="grid">
        <div class="col-2-3">
          <div class="controls">
           <input type="text" id="street" class="floatLabel" name="street" >
           <label for="street">Street</label>
          </div>          
        </div>
      </div>
      <div class="grid">
        <div class="col-2-3">
          <div class="controls">
            <input type="text" id="city" class="floatLabel" name="city" >
            <label for="city">City</label>
          </div>         
        </div>
        <div class="col-1-3">
          <div class="controls">
            <input type="text" id="post-code" class="floatLabel" name="postCode" >
            <label for="post-code">Post Code</label>
          </div>         
        </div>
      </div>
      <div class="controls">
        <input type="text" id="country" class="floatLabel" name="state" >
        <label for="country">State</label>
      </div>
  </div>
  <!--  Details -->
  <div class="form-group">
    <h2 class="heading">Details</h2>
    <div class="grid">
    <div class="col-1-4 col-1-4-sm">
      <div class="controls">
        <input type="date" id="arrive" class="floatLabel" name="date" value="<?php echo date('Y-m-d'); ?>" >
        <label for="arrive" class="label-date"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Date</label>
      </div>      
    </div>
      </div>
      <div class="grid">
    <div class="col-1-3 col-1-3-sm">
      <div class="controls">
        <i class="fa fa-sort"></i>
        <select class="floatLabel" name="tableFor">
          <option value=""></option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4+">4+</option>
        </select>
        <label for="fruit"><i class="fa fa-male"></i>&nbsp;&nbsp;Table For</label>
      </div>      
    </div>
    <div class="col-1-3 col-1-3-sm">
    <div class="controls">
      <i class="fa fa-sort"></i>
      <select class="floatLabel" name="ocassions">
        <option value=""></option>
        <option value="Casual">Casual</option>
        <option value="Birthday">Birthday</option>
        <option value="Meeting">Meeting</option>
      </select>
      <label for="fruit" >Ocassions</label>
     </div>     
    </div>

      
     </div>
      <div class="grid">
        <p class="info-text">Please describe your needs if any eg. birthday, anniversary, etc..</p>
        <br>
        <div class="controls">
          <textarea name="comments" class="floatLabel"  id="comments"></textarea>
          <label for="comments">Other Requirements</label>
          </div>
            <button style="font-weight: bold;" type="submit" value="book" name="submit" class="col-1-4">BOOK</button>
            <button style="padding-left: 10px; background-color: #00ff88; font-weight: bold;" type="submit" value="pay" name="book" class="col-1-4">BOOK & PAY WITH JUST $5</button>
      </div>  
  </div> <!-- /.form-group -->
</form>


	<script src="reservation.js"></script>


</body>
</html>
