<?php

function register($username,$password){
$conn = connect();
$sql = $conn->prepare("INSERT INTO USERS(username,password)VALUES (?,?)");
$sql->bind_param("ss",$username,$password);
return $sql -> execute();
}
?>