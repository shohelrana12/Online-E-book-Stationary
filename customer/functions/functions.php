<?php 

$db = mysqli_connect("localhost","root","","ebkkk");

/// begin getRealIpUser functions ///

function getRealIpUser(){
    
    switch(true){
            
            case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
            case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
            case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
            
            default : return $_SERVER['REMOTE_ADDR'];
            
    }
    
}

/// begin add_cart functions ///

function add_cart(){
    
    global $db;
    
    if(isset($_GET['add_cart'])){
        
        $ip_add = getRealIpUser();
        
        $b_id = $_GET['add_cart'];
        
        $product_qty = $_POST['product_qty'];
        
        //$product_size = $_POST['product_size'];
        
        $check_product = "select * from cart where ip_add='$ip_add' AND b_id='$b_id'";
        
        $run_check = mysqli_query($db,$check_product);
        
        if(mysqli_num_rows($run_check)>0){
            
            echo "<script>alert('This product has already added in cart')</script>";
            echo "<script>window.open('details.php?book_id=$b_id','_self')</script>";
            
        }else{
            
            $query = "insert into cart (b_id,ip_add,qty) values ('$b_id','$ip_add','$product_qty')";
            
            $run_query = mysqli_query($db,$query);
            
            echo "<script>window.open('details.php?book_id=$b_id','_self')</script>";
            
        }
        
    }
    
}

/// finish add_cart functions ///

/// finish getRealIpUser functions ///

/// begin getBook functions ///

function getBook(){
    
    global $db;
    
    $get_books = "select * from books order by 1 DESC LIMIT 0,8";
    
    $run_books = mysqli_query($db,$get_books);
    
    while($row_books=mysqli_fetch_array($run_books)){
        
        $book_id = $row_books['book_id'];
        
        $book_title = $row_books['book_title'];
        
        $book_price = $row_books['book_price'];
        
        $book_img1 = $row_books['book_img1'];
        
        echo "
        
        <div class='col-md-4 col-sm-6 single'>
        
            <div class='book'>
            
                <a href='details.php?book_id=$book_id'>
                
                    <img class='img-responsive' src='admin_area/product_images/$book_img1'>
                
                </a>
                
                <div class='text'>
                
                    <h3>
            
                        <a href='details.php?book_id=$book_id'>

                            $book_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                        $ $book_price
                    
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?book_id=$book_id'>

                            Read Now

                        </a>
                    
                        <a class='btn btn-primary' href='details.php?book_id=$book_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>
                    
                    </p>
                
                </div>
            
            </div>
        
        </div>
        
        ";
        
    }
    
}
/// finish getBook functions ///

/// begin getBook functions ///

  function getBcats(){

  	global $db;
    
    $get_b_cats = "select * from book_categories";
    
    $run_b_cats = mysqli_query($db,$get_b_cats);

    while($row_b_cats=mysqli_fetch_array($run_b_cats)){
    	$b_cat_id = $row_b_cats['b_cat_id'];
    	$b_cat_title = $row_b_cats['b_cat_title'];

    	echo "
    	<li>
    	     <a href='shop.php?b_cat=$b_cat_id'> $b_cat_title </a>

    	     </li>
    	";

     }
  }
  /// finish getBook functions ///

  /// begin getBook functions ///
  function getcats(){

  	global $db;
    
    $get_cats = "select * from categories";
    
    $run_cats = mysqli_query($db,$get_cats);

    while($row_cats=mysqli_fetch_array($run_cats)){
    	$cat_id = $row_cats['cat_id'];
    	$cat_title = $row_cats['cat_title'];

    	echo "
    	<li>
    	     <a href='shop.php?cat=$cat_id'> $cat_title </a>

    	     </li>
    	";

     }
  }
  
  /// finish getBook functions ///

  /// begin getbcatbook functions ///

function getbcatbook(){
    
    global $db;
    
    if(isset($_GET['b_cat'])){
        
        $b_cat_id = $_GET['b_cat'];
        
        $get_b_cat ="select * from book_categories where b_cat_id='$b_cat_id'";
        
        $run_b_cat = mysqli_query($db,$get_b_cat);
        
        $row_b_cat = mysqli_fetch_array($run_b_cat);
        
        $b_cat_title = $row_b_cat['b_cat_title'];
        
        $b_cat_desc = $row_b_cat['b_cat_desc'];
        
        $get_books ="select * from books where b_cat_id='$b_cat_id'";
        
        $run_books = mysqli_query($db,$get_books);
        
        $count = mysqli_num_rows($run_books);
        
        if($count==0){
            
            echo "
            
                <div class='box'>
                
                    <h1> No Book Found In This Book Categories </h1>
                
                </div>
            
            ";
            
        }else{
            
            echo "
            
                <div class='box'>
                
                    <h1> $b_cat_title </h1>
                    
                    <p> $b_cat_desc </p>
                
                </div>
            
            ";
            
        }
        
        while($row_books=mysqli_fetch_array($run_books)){
            
            $book_id = $row_books['book_id'];
        
            $book_title = $row_books['book_title'];

            $book_price = $row_books['book_price'];

            $book_img1 = $row_books['book_img1'];
            
            echo "
            
                <div class='col-md-4 col-sm-6 center-responsive'>
        
            <div class='book'>
            
                <a href='details.php?book_id=$book_id'>
                
                    <img class='img-responsive' src='admin_area/product_images/$book_img1'>
                
                </a>
                
                <div class='text'>
                
                    <h3>
            
                        <a href='details.php?book_id=$book_id'>

                            $book_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                        $ $book_price
                    
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?book_id=$book_id'>

                            Read Now

                        </a>
                    
                        <a class='btn btn-primary' href='details.php?book_id=$book_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>
                    
                    </p>
                
                </div>
            
            </div>
        
        </div>
            
            ";
            
        }
        
    }
    
}

/// finish getbcatbook functions ///

/// begin getcatpro functions ///

function getcatbook(){
    
    global $db;
    
    if(isset($_GET['cat'])){
        
        $cat_id = $_GET['cat'];
        
        $get_cat = "select * from categories where cat_id='$cat_id'";
        
        $run_cat = mysqli_query($db,$get_cat);
        
        $row_cat = mysqli_fetch_array($run_cat);
        
        $cat_title = $row_cat['cat_title'];
        
        $cat_desc = $row_cat['cat_desc'];
        
        $get_cat = "select * from books where cat_id='$cat_id'";
        
        $run_books = mysqli_query($db,$get_cat);
        
        $count = mysqli_num_rows($run_books);
        
        if($count==0){
            
            
            echo "
            
                <div class='box'>
                
                    <h1> No Book Found In This Category </h1>
                
                </div>
            
            ";
            
        }else{
            
            echo "
            
                <div class='box'>
                
                    <h1> $cat_title </h1>
                    
                    <p> $cat_desc </p>
                
                </div>
            
            ";
            
        }
        
        while($row_books=mysqli_fetch_array($run_books)){
            
            $book_id = $row_books['book_id'];
            
            $book_title = $row_books['book_title'];
            
            $book_price = $row_books['book_price'];
            
            $book_desc = $row_books['book_desc'];
            
            $book_img1 = $row_books['book_img1'];
            
            echo "
            
                <div class='col-md-4 col-sm-6 center-responsive'>
                                    
                    <div class='book'>
                                        
                        <a href='details.php?book_id=$book_id'>
                                            
                            <img class='img-responsive' src='admin_area/product_images/$book_img1'>
                                            
                        </a>
                                            
                        <div class='text'>
                                            
                            <h3>
                                                
                                <a href='details.php?book_id=$book_id'> $book_title </a>
                                                
                            </h3>
                                            
                        <p class='price'>

                            $$book_price

                        </p>

                            <p class='buttons'>

                                <a class='btn btn-default' href='details.php?book_id=$book_id'>

                                Read Now

                                </a>

                                <a class='btn btn-primary' href='details.php?book_id=$book_id'>

                                <i class='fa fa-shopping-cart'></i> Add To Cart

                                </a>

                            </p>
                                            
                        </div>
                                        
                    </div>
                                    
                </div>
            
            ";
            
        }
        
    }
    
}

/// finish getcatpro functions ///
/// finish getRealIpUser functions ///

function items(){
    
    global $db;
    
    $ip_add = getRealIpUser();
    
    $get_items = "select * from cart where ip_add='$ip_add'";
    
    $run_items = mysqli_query($db,$get_items);
    
    $count_items = mysqli_num_rows($run_items);
    
    echo $count_items;
    
}

/// finish getRealIpUser functions ///

/// begin total_price functions ///

function total_price(){
    
    global $db;
    
    $ip_add = getRealIpUser();
    
    $total = 0;
    
    $select_cart = "select * from cart where ip_add='$ip_add'";
    
    $run_cart = mysqli_query($db,$select_cart);
    
    while($record=mysqli_fetch_array($run_cart)){
        
        $book_id = $record['b_id'];
        
        $book_qty = $record['qty'];
        
        $get_price = "select * from books where book_id='$book_id'";
        
        $run_price = mysqli_query($db,$get_price);
        
        while($row_price=mysqli_fetch_array($run_price)){
            
            $sub_total = $row_price['book_price']*$book_qty;
            
            $total += $sub_total;
            
        }
        
    }
    
    echo "$" . $total;
    
}

/// finish total_price functions ///

?>