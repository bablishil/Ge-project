<?php 
echo "problem 0";

if(isset($_POST["submit"])){




$errors = '';
$myemail = 'bablishil16@gmail.com';
echo "problem1";

if(empty($_POST['name'])  || 
   empty($_POST['email']) || 
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}

$name = $_POST['name']; 
$email_address = $_POST['email']; 
$message = $_POST['message']; 

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)@[a-z0-9-]+(\.[a-z0-9-]+)(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}
echo "problem";
if(empty($errors))

{

$to = $myemail;

$email_subject = "Contact form submission: $name";

$email_body = "You have received a new message. "." Here are the details:\n Name: $name \n ".

"Email: $email_address\n Message \n $message";

$headers = "From: $myemail\n";

$headers .= "Reply-To: $email_address";
echo 'he';

mail($to,$email_subject,$email_body,$headers);

//redirect to the 'thank you' page
echo 'hey';
header('location: thankyou.html');

}



} 
else{
	echo "hoii";
}
?>