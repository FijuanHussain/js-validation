<?php

require 'DbConnect.php'; 
require 'DbRead.php';
$username = $password = "";
  $isValid = true;
  $usernameErr = $passwordErr = "";
  $successfulMessage = $errorMessage = "";

  if($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    }
    if(empty($username)) {
      $usernameErr = "Username can not be empty!";
      $isValid = false;
    }
    if(empty($password)) {
      $passwordErr = "Password can not be empty!";
      $isValid = false;
    }
    if($isValid) {
      if(strlen($username) > 5){
         $usernameErr = "Username max size 5!";
         $isValid = false;
      }
      if(strlen($password) > 8){
         $passwordErr = "Password max size 8!";
          $isValid = false;

      }
      if($isValid){
       $username = test_input($username);
       $password = test_input($password);


      $response = login($username,$password);
      if($response) {
        session_start();
        $_SESSION['username'] = $username;
        header("Location:Home.php");
      }
      else {
        $errorMessage = "Login Failed....!";
      }
    }
  }
  function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login Page</title>
</head>
<body>

  <h1>Login Form</h1>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" value="<?php echo $username;?>">
      <span style="color:red"><?php echo $usernameErr; ?></span>

      <br><br>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password">
      <span style="color:red"><?php echo $passwordErr; ?></span>

      <br><br>

      <input type="submit" name="submit" value="Login">
  
  </form>

  <p style="color:green;"><?php echo $successfulMessage; ?></p>
  <p style="color:red;"><?php echo $errorMessage; ?></p>

  <br>

  <p>Not registered yet?? visit  <a href="Registration.php">Registration</a></p>

</body>
</html>