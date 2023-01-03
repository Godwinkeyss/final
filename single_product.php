<?php  include('./inc/header.php')  ?>
<?php  
  include('server/connection.php');


  $product_quantity = 1;
if(isset($_GET['product_id'])){

      $product_id = $_GET['product_id'];
      
      $stmt =$pdo->prepare('SELECT * FROM products WHERE product_id=:product_id LIMIT 1');
      $stmt->bindValue(':product_id', $product_id);
      $stmt->execute();
      
      $products =$stmt->fetchAll(PDO::FETCH_ASSOC);
     

      $stmt =$pdo->prepare('SELECT * FROM products ORDER BY rand() LIMIT 4');

      $stmt->execute();

      $feature_products =$stmt->fetchAll(PDO::FETCH_ASSOC);

  // no product id was given
}else{
  header('location: index.php');
}

?>






<!-- single-product start -->
<section class="single">
<?php foreach($products as $product): ?>
<div class="single-wrapper container my-5 py-5">


    <div class="single-left">
        <img src="./images/<?php echo $product['product_image1'];?>" alt="">
    </div>
    <div class="single-right">
        <button class="button">SLAYBEAST</button>
        <div class="single-name">
            <h1><?php echo $product['product_name'];?></h1>
            <h1>£<?php echo $product['price'];?></h1>
        </div>
        <div class="single-des">
            <p><?php echo $product['product_description'];?>.</p>
        
        </div>
        <div class="single-quant mb-5">
            <div class="quant">
            <form action="addToCart.php" method="POST">

                    <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>">
                    <input type="hidden" name="product_image1" value="<?php echo $product['product_image1'];?>">
                    <input type="hidden" name="product_name" value="<?php echo $product['product_name'];?>">
                    <input type="hidden" name="product_price" value="<?php echo $product['price'];?>">

                    <span class="decrement-btn"  id="dec">-</span> 
                     
                  <input type="text" value="<?php echo $product_quantity ?>" name="product_quantity">
                <span class="increment-btn" id="inc">+</span>
            </div>
             <?php if($product['stock'] > 0):?> 
            <button class="single_cart_btn"type="submit" name="add_to_cart">Add to cart</button>
             
            <?php endif; ?>
            <?php if($product['stock'] == 0){
                echo "<p style='background-color:red; color:white;padding:5px 10px';>Out of stock</p>";
            }  ?>
            </form> 
        </div>
        <!-- acordion start-->
        <div class="accordion accordion-flush" id="accordionFlushExample ">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                   Shipping.<br><span>More Info</span>
                </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">All packages are shipped via FedEx, FedEx Smartpost or USPS.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Return & Exchange
                </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">To initiate a return or exchange<a href="returns_exchange.php"> please click here </a>to begin the return process.</div>
                </div>
            </div>
  
        </div>
    </div>
        <!-- accordion end -->
</div>
<div class="other-img container">
    <img src="./images/<?php echo $product['product_image1'];?>" alt="">
    <img src="./images/<?php echo $product['product_image2'];?>" alt="">
    <img src="./images/<?php echo $product['product_image3'];?>" alt="">
    <img src="./images/<?php echo $product['product_image4'];?>" alt="">
</div>
</form>   
<?php  endforeach;  ?>
<!-- related images -->
<div class="products-wrapper container">

    <h1 class="mt-5">Related Products</h1>
        
            <div class="row my-2 py-2"> 
            <?php foreach($feature_products as $row): ?> 
                <div class="product-card  .col-lg-3 col-md-4 col-sm-6">
                    <div class="card-image">
                    <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>">
                        <img src="./images/<?php echo $row['product_image4']; ?>" alt="" class="mainImg">
                        <img src="./images/<?php echo $row['product_image3']; ?>" alt="" class="secondImg">
                     </a>
                    </div>
                    <div class="product-name">
                        <h5><?php echo $row['product_name']; ?></h5>
                        <p>	£<?php echo $row['price']; ?></p>
                    </div>    
                </div>   
                <?php  endforeach;  ?>           
                         
                        
                          
            </div>
             
    </div>
</div>




</section>
<!-- single-product end -->




















<!-- footer section start -->
<?php  include('./inc/footer.php')  ?>

<script>
    var incrementBtn = document.getElementById('inc');
    var decrementBtn = document.getElementById('dec');
    // console.log(incrementBtn,decrementBtn);
//    for(var i = 0; i <incrementBtn.length; i++){
    // var button = incrementBtn[i];
    incrementBtn.addEventListener('click', function(event){
       var buttonClicked =  event.target;
    //    console.log(buttonClicked)
    var input = buttonClicked.parentElement.children[5];
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
    var input = buttonClicked.parentElement.children[5];
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
//    }


</script>

