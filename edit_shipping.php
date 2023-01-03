<?php
 session_start();
include('./server/connection.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php?message=Please login/register to place an order');
      
     exit;
    // if user is logged in
 }

 if(!empty($_SESSION['cart'])){
    if(isset($_GET['id'])){


        $stmt1 = $pdo->prepare('SELECT * FROM shipping_address WHERE user_id = :user_id');
        $stmt1->bindValue(':user_id',$user_id);
        $stmt_stat = $stmt1->execute();
        
        $user_id =$_SESSION['user_id'];
        if($stmt_stat > 0){
         $stmt2 = $pdo->prepare('UPDATE shipping_addrress SET email=:email,country=:country,state=:state,city=:city,address=:address,postal=:postal,phone=:phone,user_id=:user_id WHERE id =:id');
         $stmt2->bindValue(':email',$email);
         $stmt2->bindValue(':country',$country);
         $stmt2->bindValue(':state',$state);
         $stmt2->bindValue(':city',$city);
         $stmt2->bindValue(':address',$address);
         $stmt2->bindValue(':postal',$postal);
         $stmt2->bindValue(':phone',$phone);
         $stmt2->bindValue(':user_id',$user_id);
         $stmt2->bindValue(':id',$id);
        }else{
         header('location:shipping_address.php');
        }
        }
 
       


 }else{
    header('location:index.php');
 }







?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="css/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@200;300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700;900&family=Satisfy&family=Yellowtail&display=swap" rel="stylesheet">

    <!-- swipper js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    
  </head>
  <body>
      <style>
          .d-none{
              display: none;
          }
          .d-bloc{
              display: block;
          }
          .checkout-box{
            border: 1px solid gray;
            padding: 8px 10px;
            /* display: flex !important; */
            align-items: center;
            justify-content: space-between;
            display: none;
            margin-bottom: 14px;
            gap: 40px;
            transition: .3s ease-in-out;
            display: none;

          }
          .checkout-box p {
            font-size: 12px;
          }
          .d-nonee{
            display: none;
            height: 0px;
          }

          @media screen and (max-width:768px) {
            .checkout-box{
                display: flex !important;
            }
            .d-nonee{
               
            }
            .again{
                display: none;
            }
          }
      </style>
      
<div class="checkout">
    <div class="checkout-left">
        <div class="topbar">
            <h1><a href="">SLAYBEAST</a></h1>
         
            <div class="top-link">
                <a href="carts.php">Cart <i class="fa-solid fa-chevron-right"></i></a>
                <p >Information <i class="fa-solid fa-chevron-right"></i></p>
                <p >Shipping <i class="fa-solid fa-chevron-right"></i></p>
                <p >Payment <i class="fa-solid fa-chevron-right"></i></p>
            </div>
        </div>
        <div class="contact">
            <div class="contact-info">
                <h5>Contact information</h5>
                <div>Already have an account?<a href="login.php" >Log in</a></div>
                
            </div>
            <!-- <form action="./server/place_order.php" method="POST"> -->
            <form action="shipping_address.php" method="POST">
            <p class="text-center" style="color:red;">
        <?php if(isset($_GET['message'])){echo $_GET['message'];}  ?>
         <?php if(isset($_GET['message']))  {?>
             <!-- <a href="login.php" class="btn btn-primary">Login</a> -->
          <?php  } ?>
      </p>
               
            <div class="form-group">
                    <input type="email"name="email" placeholder="Email" class="" required>
                    <div class="check-m">
                        <input type="checkbox"name="checkbox" class=" check "><span>Email me with news and offers</span>
                    </div>
                    
                </div>
           
               

                <div class="ship-address">
                                      
                        <select class="form-select" name="country" id="inputGroupSelect01" onchange="enablecity(this)">
                       <?php include('./server/connection.php');?>
                       <?php include('./server/get_main_products.php') ?>
                            <option selected>Country</option>
                            <?php  foreach($country as $row):  ?>
                            <option value="<?php echo $row['country_name']  ?>"><?php echo $row['country_name']  ?></option>
                            <?php   endforeach;  ?>
                           
                        </select>
                </div>
                <div class="name form-group">
                    <input type="text"name="first_name" placeholder="First name" class=""required>
                    <input type="text"name="last_name" placeholder="Last name" class=""required>
                </div>
                <!-- <div class="form-group">
                    <input type="text"name="phone" placeholder="Phone number" class="">
                </div> -->
                <div class="form-group">
                    <input type="text"name="phone" placeholder="Phone number" class=""required>
            </div>
                
                <div class="form-group">
                <!-- <select class="form-select  d-bloc" id="city" onchange="">
                       <?php include('./server/connection.php');?>
                       <?php include('./server/get_main_products.php') ?>
                            <option selected>Choose...</option>
                            <?php  foreach($country as $row):  ?>
                            <option value="<?php echo $row['country_name']  ?>"><?php echo $row['country_name']  ?></option>
                            <?php   endforeach;  ?>
                           
                        </select> -->
                    </div>
                <div class="form-group">
                    <input type="text"name="address" placeholder="Address" class=""required >
                </div>
                <!-- <div class="form-group">
                    <input type="text"name="apartment" placeholder="Appartment" class="">
                </div> -->
                <div class="city form-group">
                    <!-- <input type="text"name="city" placeholder="City" class=""> -->

                   
                    
                  
                    <input type="text" name="postal" placeholder="Postal code" class="">
                    <select name="state" class="form-select  d-bloc" id="city" onchange="">
                       <?php include('./server/connection.php');?>
                       <?php include('./server/get_main_products.php') ?>
                            <option selected>Choose...</option>
                            <?php  foreach($states as $row):  ?>
                            <option value="<?php echo $row['state_name']  ?>"><?php echo $row['state_name']  ?></option>
                            <?php   endforeach;  ?>
                           
                        </select>
                    <input type="text" name="city" required placeholder="City" class="">
                </div>
                <div class="return">
                    <a href="cart.php" class="chev"><i class="fa-solid fa-chevron-left "></i>
                        Return to cart</a>
                        <!-- <p>Total amount: $<?php echo $_SESSION['total']  ?></p> -->
                    <button type="submit"name="place_shipping" class="continue">Continue to shipping</button>
                </div>
               
                <p>Total amount: $<?php echo $_SESSION['total']  ?></p>
            </form>
        </div>
        <hr class="hr">

        <div class="policy">
            <a href="">Refund policy</a>
            <a href="">Privacy policy</a>
            <a href="">Terms of services</a>
        </div>
    </div>
    <!-- ==============right side============================= -->
<div class="checkout-right again">
        
    <?php if(isset($_SESSION['cart'])) { ?>
        <?php foreach(($_SESSION['cart']) as $key => $value):  ?>
             
        <div class="checkout-img">
            <div class="img-check">
                <img src="./images/<?php  echo $value['product_image1']; ?>" alt="" >

                <p><?php  echo $value['product_name']; ?></p>
                <div class="number"><?php  echo $value['product_quantity']; ?></div>
            </div>
            <p>$<?php echo $value['product_quantity'] * $value['product_price']; ?></p>
        </div>
        <?php  endforeach; ?>
       <?php  } ?>
       
       
       
        <hr class="right-hr">

        <div class="discount-form">
            <form action="">
                <input type="text" placeholder="Discount Code">
                <button>Apply</button>
             </form>
        </div>
        <hr class="right-hr">

        <div class="right-sub-total">
            <span>Subtotal</span>
            <span class="span-2">$</span >
        </div>
        <div class="right-sub-total">
            <span>Shipping</span>
            <span class="span-2"id="num">$</span >
        </div>
        <hr class="right-hr again">

        <div class="right-check-total">
            <span class="span-3">Total</span>
            <span class="span-4">  </span>
        </div>
    </div>
</div>

   














<script type="text/javascript">
$(document).ready(function () {
$(document).on('click', '.refresher', function () {
$.ajax({
url: 'get_div.php',
method: "GET",
dataType: 'json',
success: function(response) {
   $('#div-to-refresh').html(response);
}
});
});
});
</script>



<script>
// document.getElementById('select').addEventListener('change', onchange);

    function onchange(e) {
    if (e.currentTarget.value === 'refresh') {
        window.location.reload();
    }
}
function enablecity(answer){
 console.log(answer.value)
 if(answer.value === 'United Kingdom'){
     document.getElementById('city').classList.add('d-bloc')
     document.getElementById('city').classList.remove('d-none')
 }else if(answer.value !== 'Nigeria'){
    document.getElementById('city').classList.add('d-none')
    document.getElementById('city').classList.remove('d-bloc')
 }
}

var checkbox = document.querySelector('.checkout-box');
var dNoone = document.querySelector('.d-nonee');

checkbox.addEventListener('click',()=>{
    dNoone.style.display = 'block';
    dNoone.style.height = '100%';
})
</script>


  


<script src="./js/custom.js"></script>
  <script src="js/bootstrap.bundle.min.js" ></script>
  <script src="js/app.js"></script>
</body>
</html>