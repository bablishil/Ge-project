<?php
	include('config/db_connect.php');
	$name = $email = $phone = $street = $city = $postCode = $state = $date = $tableFor = $ocassions =$comments  = '';
	$errors = array('name' => '', 'email' => '', 'phone' => '', 'street' => '', 'city' => '', 'postCode' => '', 'state' => '', 'date' => '', 'tableFor' => '', 'ocassions' => '');
	
	if(isset($_POST['submit'])){
		
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
			if(!is_numeric($phone) && strlen($phone)==10){
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
			if(!is_numeric($postCode) && strlen($postCode)==10){
				$errors['postCode'] = 'A valid postCode is required. eg. 781***';
			}
		}
		// check state
		if(empty($_POST['state'])){
			$errors['state'] = 'A  is state required';
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
			$errors['ocassions'] = 'ocassions';
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
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
			// create sql
			$sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";
			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
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
	
</head>
<body>

	<form action="">
		<div id="error"> <p><em><?php echo  ?></em></p></div>
  <!--  General -->
  <div class="form-group">
    <h2 class="heading">Booking & contact</h2>
    <div class="controls">
      <input type="text" id="name" class="floatLabel" name="name" required>
      <label for="name">Name</label>
    </div>
    <div class="controls">
      <input type="text" id="email" class="floatLabel" name="email" required>
      <label for="email">Email</label>
    </div>       
    <div class="controls">
      <input type="tel" id="phone" class="floatLabel" name="phone" required>
      <label for="phone">Phone</label>
    </div>
      <div class="grid">
        <div class="col-2-3">
          <div class="controls">
           <input type="text" id="street" class="floatLabel" name="street" required>
           <label for="street">Street</label>
          </div>          
        </div>
      </div>
      <div class="grid">
        <div class="col-2-3">
          <div class="controls">
            <input type="text" id="city" class="floatLabel" name="city" required>
            <label for="city">City</label>
          </div>         
        </div>
        <div class="col-1-3">
          <div class="controls">
            <input type="text" id="post-code" class="floatLabel" name="postCode" required>
            <label for="post-code">Post Code</label>
          </div>         
        </div>
      </div>
      <div class="controls">
        <input type="text" id="country" class="floatLabel" name="state" required>
        <label for="country">State</label>
      </div>
  </div>
  <!--  Details -->
  <div class="form-group">
    <h2 class="heading">Details</h2>
    <div class="grid">
    <div class="col-1-4 col-1-4-sm">
      <div class="controls">
        <input type="date" id="arrive" class="floatLabel" name="date" value="<?php echo date('Y-m-d'); ?>"  required>
        <label for="arrive" class="label-date"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Date</label>
      </div>      
    </div>
      </div>
      <div class="grid">
    <div class="col-1-3 col-1-3-sm">
      <div class="controls">
        <i class="fa fa-sort"></i>
        <select class="floatLabel" name="tableFor">
          <option value="blank"></option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4+</option>
        </select>
        <label for="fruit" required><i class="fa fa-male"></i>&nbsp;&nbsp;Table For</label>
      </div>      
    </div>
    <div class="col-1-3 col-1-3-sm">
    <div class="controls">
      <i class="fa fa-sort"></i>
      <select class="floatLabel" name="ocassions">
        <option value="blank"></option>
        <option value="deluxe">Casual</option>
        <option value="Zuri-zimmer">Birthday</option>
        <option value="Zuri-zimmer">Meeting</option>
      </select>
      <label for="fruit" required>Ocassions</label>
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
            <button type="submit" value="Submit" class="col-1-4">Submit</button>
      </div>  
  </div> <!-- /.form-group -->
</form>


	<script src="reservation.js"></script>


</body>
</html>
