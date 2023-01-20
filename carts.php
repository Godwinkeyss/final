<?php 
 include('./inc/header.php');  





                             

if(isset($_POST['add_to_cart'])){

    // if user has already added a product to cart
    if(isset($_SESSION['cart'])){
  
      $products_array_ids =array_column($_SESSION['cart'], "product_id"); //[2,3,4,10,15]
       
      // if product has already been added to cart or not
      if(!in_array($_POST['product_id'], $products_array_ids) ){
        
            $product_id = $_POST['product_id'];
           
        
            $product_array = array(
              'product_id' => $_POST['product_id'],
              'product_name' =>  $_POST['product_name'],
              'product_price' => $_POST['product_price'],
              'product_image1' => $_POST['product_image1'],
              'product_quantity' => $_POST['product_quantity'],
            );
        
            $_SESSION['cart'][$product_id] = $product_array;
            //  [2=>[], 3=>[], 5=>[]  ]
  
  
        //product has already been added
      }else{
      //  echo '<script>alert("Product was already added to the cart")</script>';
        $warning_message[] = 'Product was already added to the cart';
       //echo '<script>window.location="index.php"</script>';
      }
  
      // if this is the first product
    }else{
  
  
      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image1 = $_POST['product_image1'];
      $product_quantity = $_POST['product_quantity'];
  
      $product_array = array(
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_image1' => $product_image1,
        'product_quantity' => $product_quantity,
      );
      $success_message[] = 'Item was added to cart';
       $_SESSION['cart'][$product_id] = $product_array;
      //  [2=>[], 3=>[], 5=>[]  ]
  
    }
  
    // calculate total
    calculateTotalCart();
  
  
    // remove product from cart
  }else if(isset($_POST['remove_product'])){
  
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    header('location: carts.php');
  
    // calculate thee total
    calculateTotalCart();
  
  
  }else if(isset($_POST['edit_quantity'])){
  
    // we getbid and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];
  
    // get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];
  
    // update product quantity
    $product_array['product_quantity'] = $product_quantity;
  
    // return array back to its place
    $_SESSION['cart'][$product_id] = $product_array;
  
     // calculate thee total
     calculateTotalCart();
    
  }else{
    // header('Location:index.php');
  }
  
  function calculateTotalCart(){
    $total_price = 0;
    $total_quantity = 0;
  
    foreach($_SESSION['cart'] as $key => $value){
     $product = $_SESSION['cart'][$key];
     $price = $product['product_price'];
     $quantity = $product['product_quantity'];
  
     $total_price =$total_price +($price * $quantity);
     $total_quantity = $total_quantity + $quantity;
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
  }


?>




<!-- navbar end -->



<section class="cart carte">
    <h1 class="my-5 py-5 text-center">Basket</h1>
    <div class="cart-wrapper container">
        <div class="cart-left">
        <?php if(isset($_SESSION['cart'])) { ?>
        <?php foreach(($_SESSION['cart']) as $key => $value):  ?>
            <div class="cart-left-container">
                    <div class="image-name">
                        <img src="./images/<?php  echo $value['product_image1']; ?>" alt="">
                        <div class="price-name">
                            <p><?php  echo $value['product_name']; ?></p>
                            <p>£<?php  echo $value['product_price']; ?></p>
                            
                        </div>
                        
                    </div>
                    <div class="quants">
                    <form action="carts.php" method="POST" style="margin-top:0px; display:flex; position:relative;">
                    <!-- <a class="cart-increment-btn" id="dec" >-</a> -->
                    
             <input style="margin-right:5px;" type="number"name="product_quantity"class="input-qty" value="<?php  echo $value['product_quantity']; ?>" />
             <input type="hidden" name="product_id" value="<?php  echo $value['product_id']; ?>">
             <!-- <a class="cart-increment-btn" id="inc">+</a> -->
             <div style=""> <input type="submit" class="edit-btn" value="Edit" name="edit_quantity"style=" background-color:white;border:none;font-size:14px;margin-top:3px;position:absolute;margin-left:-2px;'" ></div>
            
           
           </form>
                        <!-- <button>-</button>
                        <input type="text" value="1">
                        <button>+</button> -->
                    </div>
                    <form action="carts.php"method="POST">
                  <input type="hidden" name="product_id" value="<?php  echo $value['product_id']; ?>">
                    <div class="del">
                    <input type="submit"id="remove" name="remove_product"style="width:100%; background-color:white;border:none;"  class="remove-btn"  value=""/>
                    
                    <label for="remove"> <i class="fa-solid fa-trash"name="remove_product" ></i></label>
                    <!-- <p><i class="fa-solid fa-trash"></i></p> -->
                        <!-- <p class="price">$5000</p> -->
                    </div>
                    </form>
                    <div class="price">
           <p>£<?php echo $value['product_quantity'] * $value['product_price']; ?></p>
           </div>
             </div>
             <?php  endforeach; ?>
       <?php  } ?>
           
        </div>

        <div class="cart-right">
            <div class="subtotal">
                <p>Subtotal:</p>
                <?php if(isset($_SESSION['cart'])){ ?>
                <p>£<?php echo $_SESSION['total']; ?></p>
            <?php  }?>
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
    // console.log(incrementBtn,decrementBtn);
   for(var i = 0; i <incrementBtn.length; i++){
    var button = incrementBtn[i];
    button.addEventListener('click', function(event){
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
   
   }
   for(var i = 0; i <decrementBtn.length; i++){
    var button = decrementBtn[i];
   
      button.addEventListener('click', function(event){
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