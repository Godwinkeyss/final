<?php
session_start();
 if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    // $_SESSION['cart'];
    if(isset($_POST['product_quantity'])){
     
      
           
        
      $product_array = array(
        'product_id' => $_POST['product_id'],
        'product_name' =>  $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_image1' => $_POST['product_image1'],
        'product_quantity' => $_POST['product_quantity'],
      );

    }else{
        $product_quantity = 1;
    }
    $product_id = $_POST['product_id'];
    $_SESSION['cart'][ $product_id] =  $product_array;
    header('Location: carts.php');

    // echo '<prev>';
    // print_r( $_SESSION['cart']);
    // echo '</prev>';
     $product_array = array(
              'product_id' => $_POST['product_id'],
              'product_name' =>  $_POST['product_name'],
              'product_price' => $_POST['product_price'],
              'product_image1' => $_POST['product_image1'],
              'product_quantity' => $_POST['product_quantity'],
            );
           

 }
 calculateTotalCart();
  
  function calculateTotalCart(){
    $total_price = 0;
    $total_quantity = 0;
  
    foreach($_SESSION['cart'] as $key => $value){
     $product = $_SESSION['cart'][$key];
     $price = $product['product_price'];
     $quantity = $product['product_quantity'];
  
     $total_price =$total_price +($price * $quantity);
     $total_quantity = $total_quantity + $quantity;
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
  }

?>