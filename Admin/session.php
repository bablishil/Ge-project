<?php
	$conn = mysqli_connect('localhost', 'Babli', '12345', 'biba');
	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	$name = $email = $phone = $street = $city = $postCode = $state = $date = $tableFor = $ocassions =$comments  = '';
	$errors = array('name' => '', 'email' => '', 'phone' => '', 'street' => '', 'city' => '', 'postCode' => '', 'state' => '', 'date' => '', 'tableFor' => '', 'ocassions' => 

?>
session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conn,"select username from user where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location: login.php");
      die();
   }