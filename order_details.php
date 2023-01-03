
<?php  include('./inc/header.php')  ?>
<?php 
include('./server/connection.php');
// not paid, delivered, shipped(key word)



if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
   

    $stmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = :order_id");

    $stmt->bindValue(":order_id", $order_id);

    $stmt->execute();
    $order_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $order_total_price = calculateTotalOrderPrice($order_details);

    $stmt1 = $pdo->prepare("SELECT * FROM orders WHERE order_id = :order_id");

    $stmt1->bindValue(":order_id", $order_id);
    $stmt1->execute();
    $orders = $stmt1->fetchAll(PDO::FETCH_ASSOC);
}else{
    header('location: account.php');
    exit;
}




function calculateTotalOrderPrice($order_details){
  $total = 0;
    foreach($order_details as $row){
     $product_price =  $row['product_price'];
     $product_quantity =  $row['product_quantity'];

    $total =  $total +  ($product_price * $product_quantity);
    }
 return $total;
}






?>




</style>

  <!-- order ddetails -->
  <section class="orders container my-5 py-3" id="orders"style="margin-bottom:400px">
        <div class="container mt-5">
          <h2 class="font-weight-bold text-center">View Orders</h2>
          <hr class="mx-auto"/>
        </div>
        
            
         
                <h4>Order Details</h4>
                
        
        <table class="mt-5 pt-5 mx-auto order_details">
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            
            
          </tr>
        

          <?php  foreach($order_details as $row):  ?>
           <tr>
            <td>
             <div class="product-info">
                 <img src="./images/<?php echo $row['product_image1'];   ?>" alt="" class="order-img">
                <div>
                    <p class="mt-3"><?php echo $row['product_name'];?></p>
                </div>
             </div>
          
            </td>
            <td>
              <span>$<?php echo $row['product_price'];?></span>
            </td>
            <td>
              <span><?php echo $row['product_quantity'];?></span>
            </td>
           
            
           
          </tr>
          <?php endforeach; ?>
         
        </table>
      
        
        <?php if($order_status == "not paid"){?>

            <form action="payment.php" method="POST" style="float:right;">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"/>
            <input type="hidden" value="<?php echo $order_total_price;?>"name="order_total_price" >
            <input type="hidden" name="order_status" value="<?php echo $order_status;  ?>">
            <input type="hidden" name="img" value="<?php echo $product_img;  ?>">
            <input type="hidden" name="qty" value="<?php echo $product_qty;  ?>">
            <input type="hidden" name="pri" value="<?php echo $product_pri;  ?>">
                <input type="submit" name="order_pay_btn" value="Pay Now" class="btn "style="background:#f25278;color:white;">
            </form>
        
    
        <?php } ?>
        
  </section>
<div class="tables my-5">
  <img src="https://th.bing.com/th/id/R.6eec247a881e6fd4a3f32636f196c7cc?rik=r2nwyZkA43OzbA&riu=http%3a%2f%2fa.abcnews.com%2fimages%2fUS%2fshopping-gty-jt-171126_4x3_608.jpg&ehk=c3zk9LD0ccgh%2fx3DdCr2lmMHmipbjKc5PIk145%2bsBgQ%3d&risl=&pid=ImgRaw&r=0" alt="" width=100% >
</div>

<style>
  .tables{
    display: none;
  }
  @media screen and (max-width:768px) {
    .tables{
      display: block !important;
    }
    .tables img{
      height: 300px;
      object-fit: cover;
      filter: brightness(.7);
    }
  }
  @media screen and (max-width:460px) {
    .tables{
    display: none !important;
  }
  }
  
</style>

  <?php  include('./inc/footer.php')  ?>
 <!-- footer -->
