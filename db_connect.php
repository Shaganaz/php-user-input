<?php
$servername="localhost";
$username="phuser";
$password="PhpUser@123";
$dbname="user_auth";

$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
  die("connection failed: " .$conn->connect_error);
}else 
{
 echo "connected successfully!";
}
?>
