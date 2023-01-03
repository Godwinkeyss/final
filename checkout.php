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
 
       
    // $stmt = $pdo->prepare('INSERT INTO coupons ');
    // $stmt->execute();

    // $coupons =$stmt->fetchAll(PDO::FETCH_ASSOC);


 }else{
    header('location:index.php');
 }
 $coupon_code= '';
if(isset($_POST['activate'])){
//  if($_SERVER['REQUEST_METHOD'] ==='POST'){
	$coupon_code = $_POST['coupon'];
	
	
    $stmt = $pdo->prepare('SELECT * FROM coupons where coupon=:coupon');
      $stmt->bindValue(':coupon', $coupon_code);
	 
      $stmt->execute();
     
      $count = $stmt->fetchColumn();

      $code =$stmt->fetch(PDO::FETCH_ASSOC);
     
    //   $array = array();


    $stmt = $pdo->query("SELECT * FROM coupons");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $discount = $row['discount'] / 100;
		$totals = $discount * $_SESSION['total'];
        $_SESSION['grand_totals'] = $totals;
       
		$total = $_SESSION['total'] - $totals;
        $_SESSION['grand_total'] = $total;
    }
      if($code >0){
       
		

     
      
      
          
		
	}

}




?>

<!-- <?php  
foreach($code as  $row){
    echo  $row['discount'];
    
    echo '<prev>';
    print_r( $row);
    echo '</prev>';
    exit;
}

?> -->

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
           
          }
      </style>
      
<div class="checkout">
    <div class="checkout-left">
        <div class="topbar">
            <h1><a href="index.php">SLAYBEAST</a></h1>
         
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
           
               <h6 class="mb-3">Shipping Address</h6>

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
                            <option selected>State</option>
                            <?php  foreach($states as $row):  ?>
                            <option value="<?php echo $row['state_name']  ?>"><?php echo $row['state_name']  ?></option>
                            <?php   endforeach;  ?>
                           
                        </select>
                    <input type="text" name="city" required placeholder="City" class="">
                </div>
                <div class="return">
                    <a href="cart.php" class="chev"><i class="fa-solid fa-chevron-left "></i>
                        Return to cart</a>
                        <!-- <p>Total amount: $<?php echo $array ?></p> -->
                    <button type="submit"name="place_shipping" class="continue">Continue to shipping</button>
                </div>
               
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
           <form action="checkout.php" method="POST">
            <input type="hidden"name="price" value="<?php echo $_SESSION['total']?>" id="price"/>

                <input type="text"  name="coupon" placeholder="Discount Code"id="coupon">
                <button name="activate"  id="activate">Apply</button>
                </form>
        </div>
        <hr class="right-hr">

        <div class="right-sub-total">
            <span>Subtotal</span>
            <span class="span-2">£<?= $_SESSION['total']  ?>  </span >
        </div>
        <div class="right-sub-total">
            <span>Discount</span>
            <span class="span-2">-£<?= $_SESSION['grand_totals']  ?> </span >
        </div>
        <div class="right-sub-total">
            <span>Shipping</span>
            <span class="span-2"id="num">£</span >
        </div>
        <hr class="right-hr again">
        <div id="result"></div>
        <div class="right-check-total">
            <span class="span-3">Total</span>
            <span id="total" class="span-4">£<?= $_SESSION['grand_total']  ?>   </span>
        </div>
    </div>
</div>

   











<script src="js/jquery-3.6.3.min.js"></script>

<!-- <script>
	$(document).ready(function(){
		$('#activate').on('click', function(){
			var coupon = $('#coupon').val();
			var price = $('#price').val();
			if(coupon == ""){
				alert("Please enter a coupon code!");
			}else{
				$.post('get_discount.php', {coupon: coupon, price: price}, function(data){
					if(data == "error"){
						alert("Invalid Coupon Code!");
						$('#total').val(price);
						$('#result').html('');
					}else{
						var json = JSON.parse(data);
						$('#result').html("<h4 class='pull-right text-danger'>"+json.discount+"% Off</h4>");
						$('#total').val(json.price);
					}
				});
			}
		});
	});
</script> -->

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

















 