<?php session_start();  ?>
<?php include('../config/dbcon.php')  ?>
<?php   
//    if(!isset($_SESSION['admin_logged_in'])){
//     header('location:login.php');
//     exit;
//    }


   if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt =$pdo->prepare("DELETE FROM coupons WHERE id=:id ");
    $stmt->bindValue(':id', $id);

    if($stmt->execute()){
        $_SESSION['message'] = "Coupon has been deleted successfully";
        header('location: coupons.php?deleted_successfully=Coupon has been deleted successfully');  
    }else{
        $_SESSION['message'] = "Could not delete Coupon";
        header('location: coupons.php?deleted_failure=Could not delete product');
    }

   
    
   }

?>