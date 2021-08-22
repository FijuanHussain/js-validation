<?php 
	require 'DbConnect.php';
	require 'DbRead.php';
	require 'DbDelete.php';
	$successfulMessage = $errorMessage = "";
	$userList = getAllUsers();

	$username =empty($_GET['username']) ? "" : $_GET['username'];
	if(empty($_GET['search']) or empty($username)){
		$userList = getAllUsers();
	}
	else {
		$userList = getUser($username);
	}

	if(!empty($_GET['uid']) and !empty($_GET['uname'])){
		$response = removeUser($_GET['uid'],$_GET['uname']);
		if($response){
			$userList = getAllUsers();
			$successfulMessage = "Successfully Deleted";
		}
		else{
			$errorMessage = "Error While Deleting...";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Users Page</title>
</head>
<body>

	<h1>Users List</h1>
	<hr>
	<form action ="<?php echo $_SERVER['PHP_SELF']; ?>"method="GET">
		<input type="text" name="username" value="<?php echo $username;?>"> 
		<input type="submit" name="search" value = "Search">
	</form>
	<br>
	<?php 
          if( count($userList) > 0) {
          
          echo "<table>";
          echo "<tr>";
          echo "<th> Id</th>";
          echo "<th> Username</th>";
          echo "<th>Action </th>";
          echo "</tr>";
         
          for($i=0;$i < count($userList);$i++){
          	echo "<tr>";
          	echo "<td>" . $userList[$i]["id"] . "</td>";
          	echo "<td>" . $userList[$i]["username"] . "</td>";
          	echo "<td> <a href='" . $_SERVER['PHP_SELF']  . "?uid=" . $userList[$i]["id"] . "&uname=" . $userList[$i]["username"] . " '>Delete</a>" . "</td>";
          	echo "<tr>";

          }
          echo "</table>";
      }
      else {
             echo "<h3>No records found.</h3>";
      }
	?>
	<br>
	<span style="color:green;"><?php echo $successfulMessage; ?></span>
	<span style="color:red;"><?php echo $errorMessage; ?></span>

	<p>Click here to <a href="Home.php">Home</a></p>
	<p>Click here to <a href="Logout.php">Logout</a></p>


</body>
</html>