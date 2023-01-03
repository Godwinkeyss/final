<?php session_start();  ?>
<?php include('../config/dbcon.php')  ?>
<?php   
//    if(!isset($_SESSION['admin_logged_in'])){
//     header('location:login.php');
//     exit;
//    }


   if(isset($_GET['shipping_id'])){
    $shipping_id = $_GET['shipping_id'];
    $stmt =$pdo->prepare("DELETE FROM shipping WHERE shipping_id=:shipping_id ");
    $stmt->bindValue(':shipping_id', $shipping_id);

    if($stmt->execute()){
        $_SESSION['message'] = "Shipping fee has been deleted successfully";
        header('location: shipping.php?deleted_successfully=Shipping fee  has been deleted successfully');  
    }else{
        $_SESSION['message'] = "Could not delete shipping fee";
        header('location: shipping.php?deleted_failure=Could not delete product');
    }

   
    
   }

?>