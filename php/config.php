<?php
 $conn = mysqli_connect("localhost","root","","chatapp");
 if(!$conn)
 {
     echo "connection successfully".mysqli_connect_error();
 }
?>