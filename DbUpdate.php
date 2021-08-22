<?php

function  changePassword($username,$password){
$conn = connect();
$sql = $conn->prepare("UPDATE USERS set password = ? WHERE username = ?");
$sql->bind_param("ss", $password,$username);
return $sql -> execute();
}
?>