<?php
  session_start();
  include_once "config.php";

  $fname = mysqli_real_escape_string($conn,$_POST['fname']);
  $lname = mysqli_real_escape_string($conn,$_POST['lname']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);

  if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password))
  {
    //   let's check user email is valid or not
      if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        //let's check that email already exist in the database or not 
        $sql = mysqli_query($conn,"SELECT email FROM users WHERE email='{$email}'");
        if(mysqli_num_rows($sql) > 0){
            echo "$email - this emali already exist!";
        }else{
            // let's check users upload file or not 
            if(isset($_FILES['image'])){
                $img_name = $_FILES['image']['name'];
                $temp_name = $_FILES['image']['tmp_name'];
                // let's the explode image to get the last extension
                $img_explode = explode(".",$img_name);
                $img_ext = end($img_explode); //here we get the extension of user uploaded image file

                $extensions = ['png','jpeg','jpg'];
                if(in_array($img_ext,$extensions)){ // check the users upload file with the array of extensions
                    $time = time();
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($temp_name,"images/".$new_img_name)){
                        $status = "Active now ";
                        $random_id = rand(time(),10000000); //craeting random id for user
                        //let's insert all the data inside table
                        $sql2 = mysqli_query($conn,"INSERT INTO users (unique_id,fname,lname,email,password,img,status) 
                        VALUES ({$random_id},'{$fname}','{$lname}','{$email}','{$password}','{$new_img_name}','{$status}')");
                        if($sql2){
                            $sql3 = mysqli_query($conn,"SELECT * FROM users WHERE email='{$email}'");
                            if(mysqli_num_rows($sql3) > 0){
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id in other file
                                echo "success";
                            }
                        }else{
                            echo "Somethings went wrong";
                        }
                    }

                }else{
                    echo "Please select an image file -jpg,jpeg,png";
                }
            }else{
                echo "Please select image file.";
            }
        }

      }else{
          echo "$email - Please enter valid email";
      }

  }else{
      echo "All input field are required";
  }


?>