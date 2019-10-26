<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['delete_book'])){
        
        $delete_id = $_GET['delete_book'];
        
        $delete_book = "delete from books where book_id='$delete_id'";
        
        $run_delete = mysqli_query($con,$delete_book);
        
        if($run_delete){
            
            echo "<script>alert('One of your book has been Deleted')</script>";
            
            echo "<script>window.open('index.php?view_books','_self')</script>";
            
        }
        
    }

?>

<?php } ?>