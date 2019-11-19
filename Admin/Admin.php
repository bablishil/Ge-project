<?php 
  include('session.php');
 //connect to the database
  $conn = mysqli_connect('localhost', 'Babli', '12345', 'biba');
  // check connection
  if(!$conn){
    echo 'Connection error: '. mysqli_connect_error();
  }

  $sql = "SELECT Id, Name, Phone_number, Table_for, Ocassions, rDate,  Other_requirements FROM reservation";
  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
 /* foreach ($data as $det) {
    foreach ($det as $key => $value) {
      echo $key . " " . $value;
      # code...
    }
  }
  mysqli_free_result($result);
   mysqli_close($conn);

  ?>*/
  ?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="../css/Admin.css">

  <title></title>
</head>
<body>
<table class="flat-table">
  <tbody>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Number of Person</th>
      <th>Occassion</th>
      <th>Date</th>
      <th>Other Requirements</th>
    </tr>
      <?php 
foreach ($data as $det) {
  ?>
  <tr>
    <?php  foreach ($det as $key => $value) {
      echo "<td> $value </td>";
      # code...
    } 
  
       ?> 
    </tr>
  <?php } ?>
  </tbody>
	</table>
</body >
</html>
<!-- login page 
about page
mail button in admin  -->
