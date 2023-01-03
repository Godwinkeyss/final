<?php session_start();  ?>
<?php include('../server/connection.php')  ?>
<?php   
//    if(!isset($_SESSION['admin_logged_in'])){
//     header('location:login.php');
//     exit;
//    }


   if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $stmt =$pdo->prepare("DELETE FROM products WHERE product_id=:product_id ");
    $stmt->bindValue(':product_id', $product_id);

    if($stmt->execute()){
        header('location: products.php?deleted_successfully=Product has been deleted successfully');  
    }else{
        header('location: products.php?deleted_failure=Could not delete product');
    }

   
    
   }

?>