<?php  include('./inc/header.php')  ?>

<?php
  
include('./server/connection.php');


if(!isset($_SESSION['logged_in'])){
  header('Location: login.php');
  exit;
}
if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['cart']);
    header('Location:login.php');
    exit;
  }
}


if(isset($_POST['change_password'])){
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirmPassword'];
      $user_email = $_SESSION['user_email'];

      // if password don't match
      if($password !== $confirmPassword){
        header("Location: account.php?error=password don't match");
      }
      // if password is less than 6 characters
      else if(strlen($password) < 6){
        header('Location: account.php?error=password must be at least 6 characters');

        // no errors
    }else{
      $stmt = $pdo->prepare('UPDATE users SET user_password = :user_password WHERE user_email=:user_email');
       $stmt->bindValue(':user_password',md5($password));
       $stmt->bindValue(':user_email',$user_email);
       if($stmt->execute()){
        header('Location:account.php?message=password has been updated successfully');
       }else{
        header('Location:account.php?error=could not update password');
       }
    }
}



// get orders

if(isset($_SESSION['logged_in'])){
    $user_id = $_SESSION['user_id'];
    $stmt =$pdo->prepare("SELECT * FROM orders WHERE user_id=:user_id");

    $stmt->bindValue(':user_id',$user_id);

    $stmt->execute();

    $orders =$stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

   <!-- navbar end -->


    <!-- Account -->
    <section class="my-5 py-5">
      <div class=" row mx-auto">

       <?php if(isset($_GET['payment_message'])){ ?>
         
        <p class="mt-5 text-center text-success h5"><?php echo $_GET['payment_message'];  ?></p>
        <?php } ?>

      
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        <p class="text-center" style="color:green"><?php if(isset($_GET['login_success'])){echo $_GET['login_success'];} ?></p>
        <p class="text-center" style="color:green"><?php if(isset($_GET['register_success'])){echo $_GET['register_success'];} ?></p>
            <h3 class="font-weight-bold">Account Info</h3>
            <hr class="mx-auto account-hr">
            <div class="account-info">
                <p>Name <span><?php if(isset($_SESSION['first_name'])) { echo $_SESSION['first_name']; }?></span></p>
                <p>Email <span><?php if(isset($_SESSION['user_email'])) { echo $_SESSION['user_email'];} ?></span></p>
                <p><a href="#orders" id="orders-btn" class="orders-btn">Your orders</a></p>
                <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
            </div>

        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 ">
            <form action="account.php"method="POST" id="account-form">
              <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
              <p class="text-center" style="color:green"><?php if(isset($_GET['message'])){echo $_GET['message'];} ?></p>
                <h3 class="text-center">Change Password</h3>
                <hr class="mx-auto account-hr">
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="account-password" placeholder="password" name="password" required  >
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" id="account-password-confirm" placeholder="confirm password" name="confirmPassword" required>
                </div>
                <div class="form-group mt-3">
                    <input type="submit" value="Change Password" id="change-pass-btn"class="" name="change_password"style="padding-top:10px;padding-bottom:30px ">
                </div>
            </form>
        </div>
      </div>
    </section>


    

     <!-- orders -->
     <section class="orders  my-1 py-1" id="orders">
        <div class="container mt-1">
          <h2 class="font-weight-bold text-center">Your Orders</h2>
          <hr class="mx-auto account-hr"/>
        </div>
        <div class="table-responsive">
        <table class="mt-1 pt-1  table table-sm">
          <tr>
            <th>Order id</th>
            <th>Order no</th>
            <th>Order cost</th>
            <th>Order status</th>
            <th>Order Date</th>
            <th>Order Details</th>
            
          </tr>
          <?php foreach($orders as $order): ?>


           <tr>
            <td>
             <!-- <div class="product-info">
                 <img src="./images/watch1.jpg" alt="">
                <div>
                    <p class="mt-3"><?php echo $order['order_id']; ?></p>
                </div>
             </div> -->
             <span><?php echo $order['order_id'] ?></span>
           
            </td>
            <td>
              <span><?php echo $order['tracking_id'] ?></span>
            </td>
            <td>
              <span><?php echo $order['order_cost'] ?></span>
            </td>
            <td>
              <span><?php echo $order['order_status'] ?></span>
            </td>
            <td>
              <span><?php echo $order['order_date'] ?></span>
            </td>
            <td>
              <form action="order_details.php"method="POST">
                <input type="hidden" value="<?php echo $order['order_status'];?>" name="order_status">
                <input type="hidden" value="<?php echo $order['order_id']; ?>" name="order_id">
                <input type="submit" class="btn order-details-btn btn-sm" value="details" name="order_details_btn"style="font-size:16px">
              </form>
            </td>
            
           
          </tr>
          
          <?php endforeach; ?>
        </table>
        </div>
        
        
  </section>




  <?php  include('./inc/footer.php')  ?>