<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $name=$_POST['name'];
   $age=$_POST['age'];

   echo "Hello "  . htmlspecialchars($name) .  " !<br>";
   echo "You are "  . htmlspecialchars($age) .  " years old";
}
?>
