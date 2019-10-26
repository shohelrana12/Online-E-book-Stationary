<?php 

include("includes/db.php");
include("functions/functions.php");

?>
<?php 

if(isset($_GET['c_id'])){
    
    $user_id = $_GET['c_id'];
    
}

$ip_add = getRealIpUser();

$status = "pending";

$invoice_no = mt_rand();

$select_cart = "select * from cart where ip_add='$ip_add'";

$run_cart = mysqli_query($con,$select_cart);

while($row_cart = mysqli_fetch_array($run_cart)){
    
    $book_id = $row_cart['b_id'];
    
    $book_qty = $row_cart['qty'];
    
   // $book_size = $row_cart['size'];
    
    $get_books = "select * from books where book_id='$book_id'";
    
    $run_books = mysqli_query($con,$get_books);
    
    while($row_books = mysqli_fetch_array($run_books)){
        
        $sub_total = $row_books['book_price']*$book_qty;
        
        $insert_user_order = "insert into user_orders (user_id,due_amount,invoice_no,qty,order_date,order_status) values ('$user_id','$sub_total','$invoice_no','$book_qty',NOW(),'$status')";
        
        $run_user_order = mysqli_query($con,$insert_user_order);
        
        $insert_pending_order = "insert into pending_orders (user_id,invoice_no,book_id,qty,order_status) values ('$user_id','$invoice_no','$book_id','$book_qty','$status')";
        
        $run_pending_order = mysqli_query($con,$insert_pending_order);
        
        $delete_cart = "delete from cart where ip_add='$ip_add'";
        
        $run_delete = mysqli_query($con,$delete_cart);
        
        echo "<script>alert('Your orders has been submitted, Thanks')</script>";
        
        echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
        
    }
    
}

?>