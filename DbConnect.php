<?php

function connect(){
$conn = new mysqli("localhost","fijuan","123","fijuanwtk");
if($conn->connect_errno){
	die("Database connection failed..." . $conn->connect_error);
}
  return $conn;
}

?>