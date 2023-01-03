<?php session_start();  ?>
<?php
include('../config/dbcon.php'); 
include('layout/header.php');

?>
    


   
<?php
  // echo '<prev>';
  // print_r( $_SESSION['admin_logged_in']);
  // echo '</prev>';
  // exit;

if(isset($_SESSION['admin_logged_in'])){
    header('location:index.php');
    exit;
}

// if($_SERVER['REQUEST_METHOD'] ==='POST'){
if(isset($_POST['admin_login_btn'])){
  $admin_email = $_POST['email'];
  $admin_password = md5($_POST['password']);
  $admin_id = $pdo->lastInsertId();


  $stmt = $pdo->prepare("SELECT * FROM admins WHERE admin_email=:admin_email AND admin_password=:admin_password LIMIT 1 ");
   
  // $stmt->bindValue(':user_id',$user_id);
  // $stmt->bindValue(':user_name',$user_name);
 
  $stmt->bindValue(':admin_email',$admin_email);
  $stmt->bindValue(':admin_password',$admin_password);
 

  if($stmt->execute()){
    // $stmt->bindValue($user_id,$user_email,$user_name, $user_password);
      // $stmt->bindValue(':admin_id',$admin_id);
      //  $stmt->bindValue(':admin_name',$admin_name);

     if($stmt->rowCount() >= 1){
      $row =  $stmt->fetch();
       $_SESSION['admin_id'] = $row['admin_id'];
       $_SESSION['admin_name'] = $row['admin_name'];
       $_SESSION['admin_email'] = $row['admin_email'];
       $_SESSION['admin_logged_in'] = true;

       header("Location:index.php?login_success=logged in successfully");
       
     }else{
      
      header("Location:login.php?error=could not verify your account");
     }


  }else{
      // error
      header("Location:login.php?error=something went wrong");
  }
}

// echo '<prev>';
//   print_r( $_SESSION['admin_logged_in']);
//   echo '</prev>';
//   exit;

?>


  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
               <h5>Slaybeast</h5>
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <?php if(isset($_SESSION['message'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?=  $_SESSION['message'];?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['message']); } ?>
              <form class="pt-3"action="login.php"method="POST">
                <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <div class="form-group">
                  <input type="email"name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password"name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <!-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="login.php" name="admin_login_btn">SIGN IN</a> -->
                  <input type="submit" value="SIGN IN" name="admin_login_btn"class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >
                </div>
                
               
               
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
 
</body>

</html>

    <!-- login -->

    <!-- footer -->
    <?php  include('layout/footer.php') ?>
   <style>
    /* ================login page start ================================================ */

.login form{
    flex-direction: column;
   width: 500px; 
}
.login form input{
    width: 100%;
    margin-bottom: 20px;
    padding: 8px 20px;
    border: 1px solid var(--main-color);
}
.login p{
    font-size: 14px;
    /* position: relative; */
    color:var(--text-color)
}
.create-acc{
  display: flex;
  padding-top: 10px;
 

}
.create-acc a{
    color:var(--main-color);
    margin-top: -2px;
}
.login div{
    position: absolute;
    margin-top: -20px;
    
    color: var(--main-color) !important;
}
.login form button{
    text-align: center;
    padding: 10px 40px;
    margin-left: 200px;
    background: var(--main-color);
    color:#fff;
    border: none;
    margin-top: 40px;
}
.underline{
    

}
.login form .create{
    /* margin-left: 40px; */
    /* margin-top: 10px; */
    /* font-family: 'Roboto', sans-serif; */
}

   </style>