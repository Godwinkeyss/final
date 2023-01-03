<?php session_start();  ?>
<?php include('../config/dbcon.php')  ?>
<?php   
//    if(!isset($_SESSION['admin_logged_in'])){
//     header('location:login.php');
//     exit;
//    }


   if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $stmt =$pdo->prepare("DELETE FROM orders WHERE order_id=:order_id ");
    $stmt->bindValue(':order_id', $order_id);

    if($stmt->execute()){
        $_SESSION['message'] = "Order has been deleted successfully";
        header('location: index.php?deleted_successfully=Order has been deleted successfully');  
    }else{
        $_SESSION['message'] = "Could not delete product";
        header('location: index.php?deleted_failure=Could not delete product');
    }

   
    
   }

?>