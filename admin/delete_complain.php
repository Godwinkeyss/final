<?php session_start();  ?>
<?php include('../config/dbcon.php')  ?>
<?php   
//    if(!isset($_SESSION['admin_logged_in'])){
//     header('location:login.php');
//     exit;
//    }


   if(isset($_GET['id'])){
    $category_id = $_GET['id'];
    $stmt =$pdo->prepare("DELETE FROM contacts WHERE id=:id ");
    $stmt->bindValue(':id', $category_id);

    if($stmt->execute()){
        $_SESSION['message'] = "Message has been deleted successfully";
        header('location: complain.php?deleted_successfully=Message has been deleted successfully');  
    }else{
        $_SESSION['message'] = "Could not delete message";
        header('location: contacts.php?deleted_failure=Could not delete message');
    }

   
    
   }

?>