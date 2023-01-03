<?php  include('./inc/header.php')  ?>
<?php
 
 
  if(isset($_POST['order_pay_btn'])){
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['user_email'];
    $product_img = $_POST['img'];
    $product_qty = $_POST['qty'];
    $product_pri = $_POST['pri'];
  }

?>




   <!-- navbar end -->

   <style>
    /* .payment{
      background-image: url('https://th.bing.com/th/id/R.789fc9d9dd198b4a7321650e2d769f82?rik=dy%2fisKC5BIRuvw&pid=ImgRaw&r=0');
      width: 100%;
      opacity: .8;
    } */
    button{
      opacity: 1;
    }
   .pay-img{
    display: flex;
    /* align-items: center; */
    justify-content: center;
    /* justify-content: space-evenly; */
   }
   .pay-img img{
    width: 200px;
   }
   </style>

<!-- Payment -->
<section class="my-5 py-5 payment">
    <div class="container text-center mt-2 pt-2">
      <h2 class="font-weight-bold h1 my-5">Payment</h2>
      <!-- <hr class="mx-auto" /> -->
    </div>
    <div class="mx-auto container text-center my-5">
      <div class="row">
    <div class="col-md-6">
       <img src="<?php echo $product_img   ?>" alt="">
    </div>
     
  <div class="col-md-6">
    <!-- <div class="pay-img">
      <img src="https://th.bing.com/th/id/R.e07dc2a987d2f9504f1675201b6f7398?rik=AqIt%2b9q2f12vtA&pid=ImgRaw&r=0" alt="">
      <img src="https://th.bing.com/th/id/R.789fc9d9dd198b4a7321650e2d769f82?rik=dy%2fisKC5BIRuvw&pid=ImgRaw&r=0" alt="" >
    </div> -->
   
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
    </div>
  </div>
   


 
  <script>
 const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_13cef54d0c840d3e824435c212523939f5043462', // Replace with your public key
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

     


  </section>    

          

  
   



  <?php  include('./inc/footer.php')  ?>















  



