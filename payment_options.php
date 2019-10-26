<div class="box"><!-- box Begin -->

	<?php 
    
    $session_email = $_SESSION['user_email'];
    
    $select_user = "select * from users where user_email='$session_email'";
    
    $run_user = mysqli_query($con,$select_user);
    
    $row_user = mysqli_fetch_array($run_user);
    
    $user_id = $row_user['user_id'];
    
    ?>
    
    <h1 class="text-center">Payment Options For You</h1>  
    
     <p class="lead text-center"><!-- lead text-center Begin -->
         
         <a href="order.php?c_id=<?php echo $user_id ?>"> Offline Payment </a>
         
     </p><!-- lead text-center Finish -->
     
     <center><!-- center Begin -->
         
        <p class="lead"><!-- lead Begin -->
            
            <a href="#">
                
                Paypal Payment
                
                <img class="img-responsive" src="images/paypal_img.jpg" alt="img-paypall">
                
            </a>
            
        </p> <!-- lead Finish -->
         
     </center><!-- center Finish -->
    
</div><!-- box Finish -->