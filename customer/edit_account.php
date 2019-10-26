<?php 

$user_session = $_SESSION['user_email'];

$get_user = "select * from users where user_email='$user_session'";

$run_user = mysqli_query($con,$get_user);

$row_user = mysqli_fetch_array($run_user);

$user_id = $row_user['user_id'];

$user_name = $row_user['user_name'];

$user_email = $row_user['user_email'];

$user_country = $row_user['user_country'];

$user_city = $row_user['user_city'];

$user_contact = $row_user['user_contact'];

$user_address = $row_user['user_address'];

$user_image = $row_user['user_image'];

?>

<h1 align="center"> Edit Your Profile </h1>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Customer Name: </label>
		<input type="text" name="c_name" class="form-control" value="<?php echo $user_name; ?>" required>
		
	</div>

	<div class="form-group">
		<label>Customer Email: </label>
		<input type="text" name="c_email" class="form-control" value="<?php echo $user_email; ?>" required>
		
	</div>

	<div class="form-group">
		<label>Customer Country: </label>
		<input type="text" name="c_countrey" class="form-control" value="<?php echo $user_country; ?>" required>
		
	</div>
	<div class="form-group">
		<label>Customer City: </label>
		<input type="text" name="c_city" class="form-control" value="<?php echo $user_city; ?>" required>
		
	</div>
	<div class="form-group">
		<label>Customer Contact: </label>
		<input type="text" name="c_contact" class="form-control" value="<?php echo $user_contact; ?>" required>
		
	</div>
	<div class="form-group">
		<label>Customer Address: </label>
		<input type="text" name="c_address" class="form-control" value="<?php echo $user_address; ?>" required>
		
	</div>
	<div class="form-group">
		<label>Customer Images: </label>
		<input type="file" name="c_image" class="form-control form-height-custom">
		<img class="img-responsive" src="customer_images/<?php echo $user_image; ?>" alt="Customer Images">

		<div class="text-center">
			<button name="update" class="btn btn-primary">
				<i class="fa fa-user-md"></i> Update Now
				
			</button>
			
		</div>
		
	</div>
	
</form>
<?php 

if(isset($_POST['update'])){
    
    $update_id = $user_id;
    
    $c_name = $_POST['c_name'];
    
    $c_email = $_POST['c_email'];
    
    $c_country = $_POST['c_country'];
    
    $c_city = $_POST['c_city'];
    
    $c_address = $_POST['c_address'];
    
    $c_contact = $_POST['c_contact'];
    
    $c_image = $_FILES['c_image']['name'];
    
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    
    move_uploaded_file ($c_image_tmp,"customer_images/$c_image");
    
    $update_user = "update users set user_name='$c_name',user_email='$c_email',user_country='$c_country',user_city='$c_city',user_address='$c_address',user_contact='$c_contact',user_image='$c_image' where user_id='$update_id' ";
    
    $run_user = mysqli_query($con,$update_user);
    
    if($run_user){
        
        echo "<script>alert('Your account has been edited, to complete the process, please Relogin')</script>";
        
        echo "<script>window.open('logout.php','_self')</script>";
        
    }
    
}

?>