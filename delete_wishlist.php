<?php session_start();  ?>
<?php include('./server/connection.php'); ?>
<?php   
//    if(!isset($_SESSION['admin_logged_in'])){
//     header('location:login.php');
//     exit;
//    }


   if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $user_id = $_SESSION['user_id'];
    $stmt =$pdo->prepare("DELETE FROM wishlists WHERE product_id=:product_id AND user_id=:user_id");
    $stmt->bindValue(':product_id', $product_id);
    $stmt->bindValue(':user_id', $user_id);

    if($stmt->execute()){
        $_SESSION['message'] = "Product has been deleted successfully";
        header('location: show_wishlist.php?deleted_successfully=Product has been deleted successfully');  
    }else{
        $_SESSION['message'] = "Could not delete product";
        header('location: show_wishlist.php?deleted_failure=Could not delete product');
    }

   
    
   }

?>