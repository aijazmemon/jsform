<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/baa765ce67.js" crossorigin="anonymous"></script>
    <title>JS form</title>
</head>
<body>
    <div class="container">
	<div class="header">
		<h2>Register!</h2>
	</div>
	<form action="connect1.php" method="POST" name="myform" id="form" class="form">
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
            <input type="radio" id="gender" name="Gender" value="m">
            <label for="Male">Male</label>
            <input type="radio" id="Female" name="Gender" value="f">
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
	
	
		<input type="submit" form="myform" name="submit" class="button" value="submit"></input>
	</form>
    <script src="app.js"> </script>
</div>

<?php

if (isset($_POST['submit'])) {
    if (isset($_POST['firstname']) && isset($_POST['lastname']) &&
        isset($_POST['email']) && isset($_POST['password']) &&
        isset($_POST['gender']) && isset($_POST['phone'])) {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "formjs";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM register WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO tbl_form (firstname, lastname, email, password, gender, phone) values(?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssssii",$firstname, $lastname, $email, $password, $gender, $phone);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}

?>


</body>

</html>


