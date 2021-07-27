<?php
 session_start();
 if(isset($_SESSION['unique_id'])){
     include_once "config.php";
     $outgoing_id = mysqli_real_escape_string($conn,$_POST['outgoing_id']);
     $incoming_id = mysqli_real_escape_string($conn,$_POST['incoming_id']);

     $output = "";
     $sql = "SELECT * FROM messages WHERE (outgoing_id={$outgoing_id} AND incoming_id = {$incoming_id}) or (outgoing_id={$incoming_id} AND incoming_id={$outgoing_id}) ORDER BY msg_id ";
     $query = mysqli_query($conn,$sql);
     if(mysqli_num_rows($query) > 0){
         while($row = mysqli_fetch_assoc($query)){
             if($row['outgoing_id'] === $outgoing_id){//he is msg sender
                $output .= '
                        <div class="chat outgoing">
                            <div class="details">
                                <p>'.$row['msg'].'</p>
                            </div>
                        </div>
                ';
             }else{//he is msg receiver
                $output .= '
                        <div class="chat incoming">
                            <img src="photo.jpg" alt="">
                            <div class="details">
                                <p>'.$row['msg'].'</p>
                            </div>
                        </div>
                
                ';

             }
         }
         echo $output;
     }

 }else{
     header("../login.php");
 }





?>