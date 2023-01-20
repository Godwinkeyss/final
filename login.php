

<?php
ob_start();
include('inc/header.php');
include('./config/dbcon.php');
?>
    



<?php   
if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $user_id = $pdo->lastInsertId();
  
  
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_email=:user_email AND password=:password LIMIT 1 ");
     
    // $stmt->bindValue(':user_id',$user_id);
    // $stmt->bindValue(':user_name',$user_name);
   
    $stmt->bindValue(':user_email',$email);
    $stmt->bindValue(':password',$password);
   
  
    if($stmt->execute()){
      // $stmt->bindParam($user_id,$user_email,$user_name, $user_password);
  
       if($stmt->rowCount() >= 1){
         $row =  $stmt->fetch();
         $_SESSION['user_id'] = $row['user_id'];
         $_SESSION['first_name'] = $row['first_name'];
         $_SESSION['user_email'] = $row['user_email'];
         $_SESSION['logged_in'] = true;
         
         $_SESSION['message'] = ' logged in successfully';
  
         header("Location:index.php?login_success=logged in successfully");
         
         
       }else{
        $_SESSION['message'] = 'could not verify your account';
        header("Location:login.php?error=could not verify your account");
       }
  
  
    }else{
        // error
        $_SESSION['message'] = ' something went wrong"';
        header("Location:login.php?error=something went wrong");
    }
}


?>

    <!-- login -->
    <div class=" my-5 py-5">
    <h1 class="text-center fs1 my-4 py-4 fw-light">Login</h1>
    <div class="login d-flex align-items-center justify-content-center ">
    <?php if(isset($_SESSION['message'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?=  $_SESSION['message'];?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['message']); } ?>
        <form action="login.php" method="POST" class="">
        <!-- <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p> -->
            <input type="text"name="email" placeholder="Email" class="">
            <br>
            <input type="password"name="password" placeholder="Password" class="">
            
            <!-- <p><a href=""> Forgot your password?</a></p> -->
            <span class="underline"></span>
            <div class="create-acc">
            <p class="create text-center">don't have an account? </p>
            <a href="register.php" class="cre">Create account</a>
            </div>
            <button type="submit" name="login_btn">Sign in</button>
           
           
           <!-- <hr> -->
        </form>
       
    </div>
    
    
</div>

    <!-- footer -->
    <?php ob_end_flush();  include('inc/footer.php') ?>