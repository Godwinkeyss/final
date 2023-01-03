<?php  include('./inc/header.php')  ?>

<?php
 include('./server/connection.php');
 $success_message = [];
if($_SERVER['REQUEST_METHOD'] ==='POST'){
  //  if(isset($_POST['submit'])){
    $email = $_POST['email'];    
    $stmt = $pdo->prepare("SELECT * FROM emails");
    $stmt->execute();
    $message =$stmt->fetchAll(PDO::FETCH_ASSOC);
      
        if($stmt -> rowCount() > 0){
          $_SESSION['message'] = "You have already subscribed. ";
          header("location:index.php?error=you have already subscribed");
          exit;
      
      }else{
        $stmt4 = $pdo->prepare("INSERT INTO emails ( email) VALUES(:email)");
        $stmt4->bindValue(':email', $email);
       
        if( $stmt4->execute()){
            // $success_message[] = 'You have successfully registered for our news letter. Thank you my highly esteemed customer';
            $_SESSION['message'] = "Thanks for subscribing. You will be alerted. ";
            header('location:index.php?success= you will be alerted. Thanks for subscribing ');
            exit;
       
      }
      }
        
     
     
    
  
     
   }

?>
   <!-- navbar end -->
   <!-- video start -->
<section class="video">

<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active c-item" data-bs-interval="10000">
      <img src="./images/DURAG.jpg" class="d-block w-100 c-img" alt="...">
      <div class="carousel-caption caption d-md-block top-0 mt-5 pt-5">
      <p class="fs-3 mt-5 pt-5">Best Services For You</p>
        <h3 class="display-3 fw-bold text-capitalize mt-3">Slay Beast</h3>
      
        <div class="slider-btn my-5">
            <button class="btn btn-1 wint">Summer Collections</button>
            <button class="btn btn-2 wint">Shop Now</button>
        </div>
      </div>
    </div>
    <div class="carousel-item c-item" data-bs-interval="2000">
      <img src="./images/WALLPAPER.jpg" class="d-block w-100 c-img" alt="...">
      <div class="carousel-caption caption d-md-block  top-0 mt-5 pt-5">
      <p class="fs-3 mt-5 pt-5">Serving You Better.</p>
        <h3 class="display-3 fw-bold text-capitalize mt-3">Slay Beast</h3>
     
        <div class="slider-btn my-5">
            <button class="btn btn-1 ">Winter Collections</button>
            <button class="btn btn-2 ">Shop Now</button>
        </div>
      </div>
    </div>
    <div class="carousel-item c-item">
      <img src="./images/WALLPAPER2.jpg" class="d-block w-100 c-img" alt="...">
      <div class="carousel-caption caption d-md-block  top-0 mt-5 pt-5">
      <p class="fs-3 mt-5 pt-5">We Are The Best.</p>
        <h3 class="display-3 fw-bold text-capitalize mt-3">Slay Beast</h3>
       
        <div class="slider-btn  my-5">
            <button class="btn btn-1">Autumn Collections</button>
            <button class="btn btn-2 ">Shop Now</button>
        </div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    
    <!-- <video src="./images/video.mp4" class="vide"width="" height="" muted autoplay loop progress ></video> -->
</section>
   <!-- video end -->
<!-- banner start -->
   <section class="home-banner">
       <div class="banner-wrapper container">
<!-- 
       <?php include('./server/get_products.php') ?>
                        <?php  foreach($feature_products as $rows):  ?>
            <div class="banner">
            <a href="single_product.php?product_id=<?php echo $rows['product_id']; ?>">
                <img src="./images/<?php echo $rows['product_image1']; ?>" alt="">
                
                </a>
                <p>Gucci shirt</p>
            </div>
            <?php endforeach;   ?>
            
           
           
       </div> -->
</section>
<!-- banner end -->

<!-- home product start -->
<section class="home-product py-md-3 my-md-3">
    <h1 class="text-center my-5 ">PRODUCTS</h1>
    
  <?php include('./server/get_main_products.php') ?>
  <?php  foreach($main_products as $row):  ?>
    <div class="big-product container">
       <div class="product-left">
       <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>">
        <img src="./images/<?php echo $row['product_image1']; ?>" alt="">
        </a>
       </div>
       <div class="product-right ">
        <h1><?php echo $row['product_name']; ?></h1>
        <p><?php echo $row['product_description']; ?>.</p>
        <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>">
        <button>Shop Now</button>
        </a>
       </div>
    </div>
   
    <?php endforeach; ?>
    
</section>
<!-- home product end -->

<!-- featured section start -->
<div class="section featured">
    <h1 class="text-center my-5">FEAUTURED</h1>
    <?php include('./server/get_main_products.php') ?>
  <?php  foreach($walls as $row):  ?>
    <div class="feature-wrapper container">
   
          <div class="feature-left">
            <a href="products.php">
            <img src="./images/<?php echo $row['images'];?>" alt="">
            </a>
          </div>
          <div class="feature-right">
            <h1 class="mb-4"><?php echo $row['names'];?></h1>
            <p><?php echo $row['description'];?></p>
            <a href="products.php"><button>Shop Now</button></a>
          </div>
    </div>
    <?php endforeach; ?>
</div>
<!-- featured section end -->
<!-- big banner start -->
<section class="big-banner">
    <img src="./images/WALLPAPER.jpg" alt="">
</section>
<!-- big banner end -->

<!-- help section start -->
<!-- <section class="help my-5 py-5">
    <h1 class="text-center">Need help?</h1>
    <div class="help-wrapper">
        <p>Our Slaybeast Team is here for you</p>
        <div class="icons">
        <i class="fa-brands fa-youtube"></i>
        <i class="fa-brands fa-instagram"></i>
        <i class="fa-brands fa-twitter"></i>
        <i class="fa-brands fa-square-facebook"></i>
        <i class="fa-brands fa-tiktok"></i>
        </div>
    </div>
</section> -->
<!-- help section end -->


<!-- subscribe section start -->
<section class="subscribe my-5 py-5">


    <h1 class="text-center">Subscribe to our email</h1>
    <div class="sub">
        <p>Be the first to know about new collections and exclusive offers.</p>
        <form action="" method="POST">
        <?php if(isset($_SESSION['message'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?=  $_SESSION['message'];?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
         <?php unset($_SESSION['message']); } ?>
            <div class="form">
                <input type="text" placeholder="email" name="email">
                <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </form>
    </div>
</section>
<!-- subscribe section start -->

<!-- footer section start -->
<?php  include('./inc/footer.php')  ?>