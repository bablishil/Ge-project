<?php 
	$conn = mysqli_connect('localhost', 'Babli', '12345', 'biba');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	$paymentid = $_POST['payid'];
	$id = $_POST['id'];
	$sql = "UPDATE reservation SET payment = '$paymentid' where id = '$id'";
	if(mysqli_query($conn, $sql)){
				// success
				//header('location: ../index.php');
				 echo ' <script type = "text/javascript"> alert("payment id  submitted successfully")</script>';
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
 ?>