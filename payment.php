<?php
 session_start();
include('./server/connection.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php?message=Please login/register to place an order');
      
     exit;
    // if user is logged in
 }

 if(!empty($_SESSION['cart'])){

//  let user in 
// $grand_total =   $_SESSION['total'] ;

// $country_name = $_POST['country'];
// $country_state = $_POST['state'];
// $stmt =$pdo->prepare('SELECT * FROM shipping WHERE country_name = :country_name and state = country_state LIMIT 1');
// $stmt->bindValue(':country_name',$country_name);
// $stmt->bindValue(':country_state',$country_state);
// $stmt->execute();

// $shippings =$stmt->fetch();

// $shipping = $shippings['price'];
// $grand_total = $grand_total + $shipping;


       


 }else{
    header('location:index.php');
 }



 if(isset($_POST['place_shipping'])){

  $email= $_POST['email'];
  $first_name= $_POST['first_name'];
  $last_name= $_POST['last_name'];
  $country= $_POST['country'];
  $state= $_POST['state'];
  $city= $_POST['city'];
  $address= $_POST['address'];
  $postal= $_POST['postal'];
  $phone= $_POST['phone'];
  $user_id =$_SESSION['user_id'];
  $id =$pdo->lastInsertId();
 

  $stmt1 = $pdo->prepare('SELECT * FROM shipping_address WHERE user_id = :user_id');
          $stmt1->bindValue(':user_id',$user_id);
          $stmt_stat = $stmt1->execute();
          $ships =$stmt1->fetchAll(PDO::FETCH_ASSOC);
  
          
          if($stmt1->rowCount() > 0){
           
            $stmt2 = $pdo->prepare('UPDATE shipping_address SET email=:email,first_name=:first_name,last_name=:last_name,country=:country,state=:state,city=:city,address=:address,postal=:postal,phone=:phone,user_id=:user_id WHERE user_id =:user_id');
            $stmt2->bindValue(':email',$email);
            $stmt2->bindValue(':first_name',$first_name);
            $stmt2->bindValue(':last_name',$last_name);
            $stmt2->bindValue(':country',$country);
            $stmt2->bindValue(':state',$state);
            $stmt2->bindValue(':city',$city);
            $stmt2->bindValue(':address',$address);
            $stmt2->bindValue(':postal',$postal);
            $stmt2->bindValue(':phone',$phone);
            $stmt2->bindValue(':user_id',$user_id);
            // $stmt2->bindValue(':id',$id);
            // echo '<prev>';
            // print_r( $id);
            // echo '</prev>';
            // exit;
            $stmt_stat = $stmt2->execute();
            echo  "user already  exist";
           
              header('location:shipping_address.php');
            
 
          }else{
            $stmt = $pdo->prepare('INSERT INTO shipping_address (email,first_name,last_name,country,state,city,address,postal,phone,user_id) VALUES(:email,:first_name,:last_name,:country,:state,:city,:address,:postal,:phone,:user_id)');
   
            $stmt->bindValue(':email',$email);
            $stmt->bindValue(':first_name',$first_name);
            $stmt->bindValue(':last_name',$last_name);
            $stmt->bindValue(':country',$country);
            $stmt->bindValue(':state',$state);
            $stmt->bindValue(':city',$city);
            $stmt->bindValue(':address',$address);
            $stmt->bindValue(':postal',$postal);
            $stmt->bindValue(':phone',$phone);
            $stmt->bindValue(':user_id',$user_id);
            $stmt_status = $stmt->execute();
      
            if($stmt->rowCount() > 0){
              // "<script>alert('already save')</script>";
               header('location:payment.php');
               exit;
            }
          }
          
          
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
         
         .topbar h1 a{
            font-size: 50px !important;
          }
          .checkout-box p {
            font-size: 12px;
          }
          .d-nonee{
            display: none;
            height: 0px;
          }
          .shipping-contact{
            border:1px solid lightgray;
            border-radius: 8px;
            padding: 10px 10px;
            margin-bottom: 30px;
            
          }
          .shipping-contact p,.shipping-contact a{
            margin-top: 20px;
          }
          .shipping-cont-div{
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* border-bottom: 1px solid gray; */
           /* margin-top: -20px; */
          }
          .shipping-cont-div p{
            margin-top: 10px;
          }
          a{
            color:red;
            font-size: 14px;
          }
          .con{
            display: flex;
            gap:10px;
          }
          .con p{
            font-size: 14px;
          }
          .none{
            display: none;
          }
          .shipping-method{
            margin-top: 60px;
            /* margin-bottom: 250px; */
          }
          .ret{
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 150px;
          }
          .ret button{
            padding: 10px 20px;
            border: none;
            background: #f25278;
            color:#fff;
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
            .checkout-right{
            margin-top: -100px;
          }
          .policy{
            /* margin-top: 150px; */
          }
          .none{
            display: block;
          }
          .yes{
            display:none ;
          }
          }
          @media screen and (max-width:460px){
            .con{
                flex-direction: column;
                gap: 0px;
            }
            .shipping-cont-div p{
            margin-top: 0px;
          }
          .shipping-cont-div p:last-child{
            margin-top: -10px;
          }
          .checkout-right{
            margin-top: -100px ;
          }
          .ret {
          flex-direction: column-reverse;
          }
          
          .ret form {
            width: 100%;
          }
          .ret form button{
            width: 100%;
            margin-bottom: 10px;
          }
          
          }
      </style>
      
<div class="checkout">
    <div class="checkout-left">
        <div class="topbar">
            <h1><a href="index.php">SLAYBEAST</a></h1>
         
            <div class="d-nonee">
            <div class="checkout-right">
        
        
           
           
           
            <hr class="right-hr">
    
            
           
    
          
            
    
           
        </div>
            </div>
            <div class="top-link">
                <a href="carts.php">Cart <i class="fa-solid fa-chevron-right"></i></a>
                <p > <a href="checkout.php">Information <i class="fa-solid fa-chevron-right"></i></a> </p>
                <p >Shipping <i class="fa-solid fa-chevron-right"></i></p>
                <p >Payment <i class="fa-solid fa-chevron-right"></i></p>
            </div>
        </div>
        <div class="shipping-contact">
             <?php

$user_id =$_SESSION['user_id'];
  

$id = $pdo->lastInsertId();
$stmt =$pdo->prepare('SELECT * FROM shipping_address WHERE user_id = :user_id ');
$stmt->bindValue(':user_id',$user_id);
// $stmt->bindValue(':user_id',$user_id);
$stmt->execute();

$ships =$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
            <?php foreach($ships as $orders):   ?>
            <div class="shipping-cont-div">
                <div class="con">
                 <p>Contact</p>
                <p><?=  $orders['email'] ?></p>
                </div>
                <p>
               
                  <a href="checkout.php?id=<?php echo $orders['id']; ?>">Change</a>
                
                </p>
            </div>
            <hr>
            <div class="shipping-cont-div">
                <div class="con">
                <p>Ship to</p>
                <p><?=  $orders['address'] ?>,<?=  $orders['city'] ?>,<?=  $orders['state'] ?>,<?=  $orders['country'] ?></p>
                </div>

                <p>
              
                  <a href="checkout.php?id=<?php echo $orders['id']; ?>">Change</a>
                
                </p>
            </div>
            <?php endforeach;  ?>
           </div>
           <div class="shipping-method shipping-contact">
           
           <p>Standard (International) - 14 to 21 Business Days</p>
           </div>

           <div class="ret">
           
            <form action="./server/place_order.php" method="POST">
              <?php foreach($ships as $ship):  ?>
                <input type="hidden" name="email" value="<?= $ship['email'];   ?>">
                <!-- <input type="hidden" name="checkbox" value="<?= $ship['checkbox'];   ?>"> -->
                <input type="hidden" name="country" value="<?= $ship['country'];   ?>">
                <input type="hidden" name="first_name" value="<?= $ship['first_name'];   ?>">
                <input type="hidden" name="last_name" value="<?= $ship['last_name'];   ?>">
                <input type="hidden" name="phone" value="<?= $ship['phone'];   ?>">
                <input type="hidden" name="city" value="<?= $ship['city'];   ?>">
                <input type="hidden" name="address" value="<?= $ship['address'];   ?>">
                <input type="hidden" name="state" value="<?= $ship['state'];   ?>">
                <input type="hidden" name="postal" value="<?= $ship['postal'];   ?>">
            
            <?php  endforeach;  ?>
            </form>
             
           </div>
           <div class="payments"  style="margin-top:-130px">
            
      <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>
        <?php $amount =strval( $_POST['order_total_price'] ) ?>
        <?php $order_id = $_POST['order_id']; ?>
          <p>Total Payment: $<?php echo $_POST['order_total_price']   ?></p>
          <form id="paymentForm">
                <div class="form-group">
                
                  <input type="hidden"value="<?php echo $_SESSION['user_email']   ?>" id="email-address" required placeholder="email" style="width:400px; border-radius:5px;margin-bottom:10px;" />
                </div>
                <!-- <div class="form-group">
                <p class="text-center">Total payment:  </p>
                  <input class="text-center" width="50" style="border:none;outline:none;" type="tel" id="amount" required disabled  value="$<?php echo $_SESSION['total'] ?>"/>
                </div> -->
                <div class="form-group">
                 
                  <input type="hidden" id="first-name" value="<?php echo $_SESSION['first_name']  ?>" placeholder="first name"style="width:400px; border-radius:5px;margin-bottom:10px;"/>
                </div>
                <div class="form-group">
                 
                  <input type="hidden" id="last-name"value="<?php echo $_SESSION['last_name']  ?>" placeholder="last name" style="width:400px; border-radius:5px;margin-bottom:10px;"/>
                </div>
                <div class="form-submit">
                  <button type="submit"style="width:400px; border-radius:5px;" onclick="payWithPaystack()"> Pay Now </button>
                </div>
          </form>
          <p>your payment is sure</p>
          <script src="https://js.paystack.co/v1/inline.js"></script>


      <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0){ ?>
        <?php $amount =strval( $_SESSION['total'] ) ?>
        <?php $order_id = $_SESSION['order_id']; ?>
          <p>Total payment:$<?php echo $_SESSION['total'];?></p>
          <form id="paymentForm">
                <div class="form-group">
                
                  <input type="hidden"value="<?php echo $_SESSION['user_email']   ?>" id="email-address" required placeholder="email" style="width:400px; border-radius:5px;margin-bottom:10px;" />
                </div>
                <!-- <div class="form-group">
                <p class="text-center">Total payment:  </p>
                  <input class="text-center" width="50" style="border:none;outline:none;" type="tel" id="amount" required disabled  value="$<?php echo $_SESSION['total'] ?>"/>
                </div> -->
                <div class="form-group">
                 
                  <input type="hidden" id="first-name" value="<?php echo $_SESSION['first_name']   ?>" placeholder="first name"style="width:400px; border-radius:5px;margin-bottom:10px;"/>
                </div>
                <div class="form-group">
                 
                  <input type="hidden" id="last-name"value="<?php echo $_SESSION['last_name']  ?>" placeholder="last name" style="width:400px; border-radius:5px;margin-bottom:10px;"/>
                </div>
                <div class="form-submit">
                  <button type="submit"style="width:400px; border-radius:5px;" onclick="payWithPaystack()"> Pay Now </button>
                </div>
          </form>
          <!-- <div class="payImg">
            <img src="https://th.bing.com/th?id=OIF.n2t1%2boxj%2fm1KEFEySLrSgA&pid=ImgDet&rs=1" alt="">
          </div> -->
          <script src="https://js.paystack.co/v1/inline.js"></script>

          <!-- <input type="submit" class="btn btn-primary" value="Pay Now"> -->
      

      



      <?php } else{ ?>
        <p class="text-danger">You don't have an order</p>
      <?php } ?>
           </div>
       
        <hr class="hr yes">

        <div class="policy  yes">
            <a href="">Refund policy</a>
            <a href="">Privacy policy</a>
            <a href="">Terms of services</a>
        </div>
    </div>
    <!-- ==============right side============================= -->
    <div class="checkout-right ">
        
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

            <hr class="hr none">

            <div class="policy  none">
                <a href="">Refund policy</a>
                <a href="">Privacy policy</a>
                <a href="">Terms of services</a>
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
 }else if(answer.value !== 'United Kingdom'){
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



<script>
 const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: '', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: '<?php echo $amount;  ?>' * 100,
    ref: 'GP'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      window.location = "http://localhost/slaybeast-php/home.php?transaction=cancel"
      alert('Transaction Failed!.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);
      // window.location = "http://localhost/grapec/verify_transaction.php?reference=" + response.reference;
      window.location.href = "server/complete_payment.php?reference=" + response.reference+"&order_id="+<?php echo $order_id; ?>

    }
  });

  handler.openIframe();
}
</script>
  


<script src="./js/custom.js"></script>
  <script src="js/bootstrap.bundle.min.js" ></script>
  <script src="js/app.js"></script>
</body>
</html>