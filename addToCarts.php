<?php
session_start();
if(isset($_POST['add_to_cart'])){

    if(isset($_POST['product_quantity'])){
     $quantity = $_POST['product_quantity'];
     $price = $_POST['product_price'];
    //  $price = $_POST['product_price'];
    }else{
        $quantity = 1;
    }
    $id = $_POST['product_id'];
    $_SESSION['cart'][$id] = array('product_quantity'=>$quantity,
'product_price'=>$price,'product_id'=>$id);
    header('location:carts.php');
    // echo '<pre>';
    //  print_r($_SESSION['cart']);
    // echo '</pre>';
}


?>