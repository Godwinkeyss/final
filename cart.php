

<?php
include('inc/header.php');
include('server/connection.php');

$cart = $_SESSION['cart'];
$total = 0;

// function calculateTotalCart(){
//     $total_price = 0;
//     $total_quantity = 0;
  
//     foreach($_SESSION['cart'] as $key => $value){
//      $product = $_SESSION['cart'][$key];
//      $price = $product['product_price'];
//      $quantity = $product['product_quantity'];
  
//      $total_price =$total_price +($price * $quantity);
//      $total_quantity = $total_quantity + $quantity;
//     }
//     $_SESSION['total'] = $total_price;
//     $_SESSION['quantity'] = $total_quantity;
//   }


?>




<!-- navbar end -->



<section class="cart">
    <h1 class="my-5 py-5 text-center">Basket</h1>
    <div class="cart-wrapper container">
        <div class="cart-left">
        <?php if(isset($_SESSION['cart'])) { ?>
        <?php foreach($cart as $key => $value){

    // echo $key ." : ". $value['product_quantity']. "<br>";
    include('server/connection.php');
    $stmt =$pdo->prepare('SELECT * FROM products WHERE product_id = :product_id');
    $stmt->bindValue(':product_id',$key);
     
    $stmt->execute();
    
    $row =$stmt->fetch();

    ?>




            <div class="cart-left-container">
                    <div class="image-name">
                        <img src="./images/<?php  echo $row['product_image1']; ?>" alt="">
                        <div class="price-name">
                            <p><?php  echo $row['product_name']; ?></p>
                            <p><?php  echo $row['price']; ?></p>
                            
                        </div>
                        
                    </div>
                    <div class="quant">
                    <form action="carts.php" method="POST" style="margin-top:0px; display:flex; position:relative;">
                    <a class="cart-increment-btn" id="dec" >-</a>
             <input type="text"name="product_quantity"class="input-qty" value="<?php  echo $value['product_quantity']; ?>" />
             <input type="hidden" name="product_id" value="<?php  echo $value['product_id']; ?>">
             <a class="cart-increment-btn" id="inc">+</a>
             <div style=""> <input type="submit" class="edit-btn" value="Edit" name="edit_quantity"style=" background-color:white;border:none;font-size:16px;margin-top:3px;position:absolute;margin-left:-8px;'" ></div>
            
           
           </form>
                        <!-- <button>-</button>
                        <input type="text" value="1">
                        <button>+</button> -->
                    </div>
                    
                  
                    <div class="del">
                    
                    
                     <a href="deleteCart.php?product_id=<?php  echo $key; ?>"><i class="fa-solid fa-trash" ></i></a>
                    <?php echo $value['product_quantity'] * $row['price']  ?>
                    <!-- <p><i class="fa-solid fa-trash"></i></p> -->
                        <!-- <p class="price">$5000</p> -->
                    </div>
                   
             </div>
             <?php
             $total = $total + ($row['price'] * $value['product_quantity']);
            }?> 
         <?php   } ?>
        </div>
        <div class="cart-right">
            <div class="subtotal">
                <p>Subtotal:</p>
                <?php echo $total ?>
            </div>
           
            <p class="tax">Taxes and shipping calculated at checkout</p>
            <form action="checkout.php" method="POST">
            <button type="submit" name="checkout">Checkout</button>
            </form>
        </div>
    </div>
</section>















<?php  include('./inc/footer.php')  ?>


<script>
   var incrementBtn = document.getElementById('inc');
            var decrementBtn = document.getElementById('dec');
            console.log(incrementBtn,decrementBtn);
           for(var i = 0; i <incrementBtn.length; i++){
            var button = incrementBtn[i];

            incrementBtn.addEventListener('click', function(event){
            var buttonClicked =  event.target;
            //    console.log(buttonClicked)
            var input = buttonClicked.parentElement.children[1];
            // console.log(input)
            var inputValue = input.value;
            // console.log(inputValue);
            var newValue = parseInt(inputValue) + 1;
            // console.log(newValue)
            input.value = newValue;
            })
            decrementBtn.addEventListener('click', function(event){
            var buttonClicked =  event.target;
            //    console.log(buttonClicked)
            var input = buttonClicked.parentElement.children[1];
            // console.log(input)
            var inputValue = input.value;
            // console.log(inputValue);
            var newValue = parseInt(inputValue) - 1;
            // console.log(newValue)
            input.value = newValue;

            if(newValue >= 1){
                input.value = newValue;
            }else{
                input.value = 1;
            }
            })
           }
</script>
