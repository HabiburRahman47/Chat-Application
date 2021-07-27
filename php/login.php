<?php
  session_start();
  include_once "config.php";

  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);
  
  if(!empty($email) && !empty($password)){
    //   let's check users entered email and password matched with database email and password
    $sql = mysqli_query($conn,"SELECT * FROM users where email='{$email}' and password='{$password}'");
    if(mysqli_num_rows($sql)>0){
       $row = mysqli_fetch_assoc($sql);
       $_SESSION['unique_id'] = $row['unique_id'];
       echo "success";
    }else{
        echo "Invalid email or password";
    }

  }else{
      echo "All inputs are required";
  }



?>