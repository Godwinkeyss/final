<?php session_start();  ?>
<?php include('../config/dbcon.php')  ?>
<?php   
//    if(!isset($_SESSION['admin_logged_in'])){
//     header('location:login.php');
//     exit;
//    }


   if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $stmt =$pdo->prepare("DELETE FROM categories WHERE category_id=:category_id ");
    $stmt->bindValue(':category_id', $category_id);

    if($stmt->execute()){
        $_SESSION['message'] = "Product has been deleted successfully";
        header('location: categories.php?deleted_successfully=Product has been deleted successfully');  
    }else{
        $_SESSION['message'] = "Could not delete product";
        header('location: categories.php?deleted_failure=Could not delete product');
    }

   
    
   }

?>