<?php 
// session_start();
ob_start();
include('./inc/header.php');  



include('./server/connection.php');
$messages = [];
// if($_SERVER['REQUEST_METHOD'] ==='POST'){
   if(!isset($_SESSION['user_id'])){
   header('location:show_wishlist.php?message=Please login to continue');
  
$_SESSION['message'] = "Please login to add item to wishlist ";
    // $messages[] = 'Please login to add item to wishlist';
    
        
   }
   
   else{
    $product_id = $_GET['product_id'];    
    $user_id = $_SESSION['user_id']; 
       
    $stmt = $pdo->prepare("SELECT * FROM wishlists WHERE product_id=:product_id AND user_id=:user_id");
    $stmt->bindValue(':product_id', $product_id);
    $stmt->bindValue(':user_id', $user_id);
     $stmt->execute();
    
      
        if($stmt ->rowCount() > 0){
            $_SESSION['message'] = "Product already exist in wishlist.  ";

          $messages[] = "Product already exist in wishlist. ";
          header("location:show_wishlist.php?error=Product already exist in wishlist");
          
      
      }else{
      
            $product_id = $_GET['product_id'];    
            $user_id = $_SESSION['user_id']; 
            $stmt4 = $pdo->prepare("INSERT INTO wishlists ( product_id, user_id) VALUES(:product_id,:user_id)");
            $stmt4->bindValue(':product_id', $product_id);
            $stmt4->bindValue(':user_id', $user_id);
           
            if( $stmt4->execute()){
                // $success_message[] = 'You have successfully registered for our news letter. Thank you my highly esteemed customer';
                $_SESSION['message'] = "Product was successfully added to wishlist. ";
        
                header('location:show_wishlist.php?success= Product was successfully added to wishlist ');
                // exit;
           
          }
          
      }
      
      
   }
  



                             


   ob_end_flush();
?>




