<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/baa765ce67.js" crossorigin="anonymous"></script>
    <title>JS Form</title>
</head>
<body>
    <div class="container">
	<div class="header">
		<h2>Register!</h2>
	</div>
	<form action="conn.php" method="post"  id="form" class="form">
    <!--First name-->
		<div class="form-control">
			<label for="firstname">First name</label>
			<input type="text" placeholder="Aijaz" id="firstname" name="firstname" />
			<i class="fas fa-check-circle"></i>
			<i class="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
    <!--Last name-->
    <div class="form-control">
			<label for="lastname">Last name</label>
			<input type="text" placeholder="Memon" id="lastname" name="lastname"/>
			<i class="fas fa-check-circle"></i>
			<i class="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
    <!--Email-->
		<div class="form-control">
			<label for="email">Email</label>
			<input type="email" placeholder="work.aijaz@gmail.com" id="email" name="email" />
			<i class="fas fa-check-circle"></i>
			<i class="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
    <!--Password-->
		<div class="form-control">
			<label for="username">Password</label>
			<input type="password" placeholder="Password" id="password" name="password"/>
			<i class="fas fa-check-circle"></i>
			<i class="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
    <!--Re enter password-->
		<div class="form-control">
			<label for="username">Re-enter Password</label>
			<input type="password" placeholder="Password" id="password2" name="password2"/>
			<i class="fas fa-check-circle"></i>
			<i class="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
    
    <!--Gender-->
        <div class="form-control">
            <p>Gender:</p>
            <div class="radio-align">
            <input type="radio" id="gender" name="gender" value="m">
            <label for="Male">Male</label>
            <input type="radio" id="Female" name="gender" value="f">
            <label for="Female">Female</label> 
            </div>
            <i class="fas fa-check-circle"></i> 
            <i class="fas fa-exclamation-circle"></i>
             <small>Error message</small>
         </div>
    
    <!--phone-->
		<div class="form-control">
			<label for="phone">Phone number</label>
            <input type="number" id="phone" name="phone" placeholder="0987654321" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
			<i class="fas fa-check-circle"></i>
			<i class="fas fa-exclamation-circle"></i>
			<small>Error message</small>
		</div>
	
	<!--submit-->
		<button type="submit" name="submit" class="button">Submit</button>
	</form>
    <script src="app.js"> </script>
</div>





<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
 
  
  // Connecting to the Database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "formjs";

  // Create a connection
  $conn = mysqli_connect($servername, $username, $password, $database); 


  if ($conn){echo "Successful";}
  // Die if connection was not successful
  if (!$conn){
      die("Sorry we failed to connect: ". mysqli_connect_error());
  }
  else{ 
    // Submit these to a database
    // Sql query to be executed 
    $sql = "INSERT INTO `tbl_form` (`firstname`, `lastname`, `email`, `password`, `gender`, `phone`) VALUES ('$firstname', '$lastname', '$email', '$password', '$gender', '$phone' )";
    $result = mysqli_query($conn, $sql);
  }
  if($result){
    echo "Your entry has been submitted successfully!";
  
  }
  else{
      // echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
      echo "We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!";
   }
}

?>



</body>

</html>
