<center>
	<h1> Do You Want To Delete Your Account ? </h1>

	<form action="" method="post">
		<input type="submit" name="Yes" value="Yes, I Want To Delete" class="btn btn-danger">
		<input type="submit" name="No" value="No, I Don't Want To Delete" class="btn btn-primary">
		
	</form>
</center>

<?php 

$c_email = $_SESSION['user_email'];

if(isset($_POST['Yes'])){
    
    $delete_user = "delete from users where user_email='$c_email'";
    
    $run_delete_user = mysqli_query($con,$delete_user);
    
    if($run_delete_user){
        
        session_destroy();
        
        echo "<script>alert('Successfully delete your account, feel sorry about this. Good Bye')</script>";
        
        echo "<script>window.open('../index.php','_self')</script>";
        
    }
    
}

if(isset($_POST['No'])){
    
    echo "<script>window.open('my_account.php?my_orders','_self')</script>";
    
}

?>