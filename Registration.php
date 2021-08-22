<!DOCTYPE html>
<html>
<body>

<h1>Registration form:</h1>

<?php 
require 'DbConnect.php'; 
require 'DbInsert.php';

$firstName= $lastName ="";
$firstNameErr = $lastNameErr = "";
$igender = $birthday = $religion = $email = $username = $password = "" ; 
$igenderErr= $birthdayErr = $religionErr = $emailErr = $usernameErr = $passwordErr = "";
$isValid = true;
$successfulMessage = $errorMessage = "";

if($_SERVER['REQUEST_METHOD']==="POST"){
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $igender = $_POST['igender'];
  $birthday = $_POST['birthday'];
  $religion = $_POST['religion'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  if(empty($firstName)){
    $firstNameErr= "First name can not be empty";
    $isValid = false;
  }
  if(empty($lastName)){
    $lastNameErr= "Last name can not be empty";
    $isValid = false;
  }
  if(empty($igender)){
    $igenderErr= "Gender field can not be empty";
    $isValid = false;
  }
  if(empty($birthday)){
    $birthdayErr= "Birthdate field can not be empty";
    $isValid = false;
  }
  if(empty($religion)){
    $religionErr= "You have forgate to select Religion";
    $isValid = false;
  }
  if(empty($email)){
    $emailErr= "Email field can not be empty";
   $isValid = false;
  }
  if(empty($username)){
    $usernameErr= "username field can not be empty";
    $isValid = false;
  }
  if(empty($password)){
    $passwordErr= "Password field can not be empty";
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

       $response = register($username,$password);
       if($response) {
        $successfulMessage = "Successfully saved.";
      }
      else {
        $errorMessage = "Error while saving.";
      }
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




<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
 <fieldset>
  <legend>Basic Information:</legend>
  <label for="firstName">First Name<span style="color: red;">*</span>:</label>
  <input type="text" id="firstName" name="firstName">
  <span style="color: red;"><?php echo $firstNameErr; ?></span>
  <br><br>
  <label for="lastName">Last Name<span style="color: red;">*</span>:</label>
  <input type="text" id="lastName" name="lastName">
  <span style="color: red;"><?php echo $lastNameErr; ?></span>
  <br><br>
  
  <label for="gender">Gender<span style="color: red;">*</span>:</label>
  <input type="radio" id="male" name="igender" value="male">

  
  <label for="male">Male</label>
  <input type="radio" id="female" name="igender" value="female">
  
  <label for="female">Female</label>
  <span style="color: red;"><?php echo $igenderErr; ?></span>
  <br><br>
  
  <label for="birthday">Birthdate<span style="color: red;">*</span>:</label>
  <input type="date" id="birthday" name="birthday">
  <span style="color: red;"><?php echo $birthdayErr; ?></span>
  <br><br>
  
  <label for="religion">Religion<span style="color: red;">*</span>:</label>

<select name="religion" id="religion">
  <option value="">Select</option>
  <option value="islam">Islam</option>
  <option value="hindu">Hindu</option>
  <option value="christian">Christian</option>
  <option value="budda">Budda</option>
  <span style="color: red;"><?php echo $religionErr; ?></span>
</select> 
 </fieldset>





 <fieldset>
  <legend>Contact Information:</legend>
  <label for="preAddress">Present Address:</label>
  <textarea id="preAddress" name="preAddress" rows="2" cols="30"> 
  </textarea>
  <br><br>
  <label for="perAddress">Permanent Address:</label>
  <textarea id="perAddress" name="perAddress" rows="2" cols="30"> 
  </textarea> 
  <br><br>
  <label for="phone">Phone(tel):</label>
  <input type="tel" id="phone" name="phone" pattern="">
  <br><br>
  <label for="email">Email<span style="color: red;">*</span>:</label>
  <input type="email" id="email" name="email">
  <span style="color: red;"><?php echo $emailErr ?></span>
  <br><br>
  <label for="homepage">Personal Website Link:</label>
  <input type="url" id="homepage" name="homepage"> 
  <br><br>

 </fieldset>



 <fieldset>
  <legend>Account Information:</legend>
  <label for="username">Username<span style="color: red;">*</span>:</label>
  <input type="text" id="username" name="username">
  <span style="color: red;"><?php echo $usernameErr; ?></span>
  <br><br>
  <label for="password">Password<span style="color: red;">*</span>:</label>
  <input type="text" id="password" name="password">
  <span style="color: red;"><?php echo $passwordErr; ?></span>
  <br><br>
</fieldset>
 <br>
 <input type="submit" name = "submit" value="Register">

</form>
<p style="color:green;"><?php echo $successfulMessage; ?></p>
  <p style="color:red;"><?php echo $errorMessage; ?></p>

  <br>

  <p>Back to <a href="Login.php">Login</a></p>


</body>
</html>
