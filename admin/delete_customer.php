<?php session_start();  ?>
<?php include('../config/dbcon.php')  ?>
<?php   
//    if(!isset($_SESSION['admin_logged_in'])){
//     header('location:login.php');
//     exit;
//    }


   if(isset($_GET['user_id'])){
    $category_id = $_GET['user_id'];
    $stmt =$pdo->prepare("DELETE FROM users WHERE user_id=:user_id ");
    $stmt->bindValue(':user_id', $category_id);

    if($stmt->execute()){
        $_SESSION['message'] = "User has been deleted successfully";
        header('location: customers.php?deleted_successfully=Message has been deleted successfully');  
    }else{
        $_SESSION['message'] = "Could not delete message";
        header('location: customers.php?deleted_failure=Could not delete message');
    }

   
    
   }

?>