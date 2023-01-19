<?php  include('./inc/header.php');  


include('./server/connection.php');

   
  



                             



?>




<!-- navbar end -->



<section class="wish">
   
<h1 class="my-5 py-5 text-center mt-5">My Wishlist</h1>
<div class="mess"style="align-items:center;display:flex; justify-content:center">
<?php if(isset($_SESSION['message'])) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Hey!</strong> <?=  $_SESSION['message'];?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['message']); } ?>
</div>
     <div class="wish-cont">
        <h5>Love It? Add To My Wishlist</h5>
        <p>My Wishlist allows you to keep track of all of your favorites and shopping activity whether you're on your computer, phone, or tablet. You won't have to waste time searching all over again for that item you loved on your phone the other day - it's all here in one place!</p>

        <a href=''>Continue shopping</a>
     </div>

    <div class="wishlist_container container">
    
      
           <?php  if(isset($_SESSION['user_id'])){ ?> 
            <?php 
             
             $user_id = $_SESSION['user_id']; 
                
             $stmt = $pdo->prepare("SELECT * FROM wishlists JOIN products on products.product_id=wishlists.product_id WHERE user_id=:user_id");
             // $stmt->bindValue(':product_id', $product_id);
             $stmt->bindValue(':user_id', $user_id);
             $stmt->execute();
             $message =$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($message as $me):  ?>
            <?php  if($me) { ?>

             <div class="wishlist_container">
                <div class="wishlist">
                        
                        <img src="./images/<?php echo $me['product_image1']; ?>" alt="">
                        <div class="wish_info">
                        <h5><?php echo $me['product_name'];  ?></h5>
                        <h5>£<?php echo $me['price'];  ?></h5>
                        </div>
                      
                        <div class="wish_del">
                        <a href="single_product.php?product_id=<?php echo $me['product_id']   ?>">Add to cart</a>
                            <a href="delete_wishlist.php?product_id=<?php echo $me['product_id'] ?>&user_id=<?php echo $_SESSION['user_id'] ?>">Delete</a>
                        </div>
                       
                    </div>
             </div>
                    
        

       
       
        <?php }  ?>
     <?php endforeach;  ?>
     <?php }else{
        
        // echo "No items ";
     }  ?>
       
    </div>
</section>















<?php  include('./inc/footer.php')  ?>


