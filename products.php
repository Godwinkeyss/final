<?php  include('./inc/header.php')  ?>
<?php  include('server/connection.php') ?>

<?php  


// use the search secttion
if(isset($_POST['search'])){
     //1 determine page number

     if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        // if user has already entered page then ppage number is the one that he selected
        $page_no = $_GET['page_no'];
    }else{
        // if user just entered then page default page is 1
        $page_no =1;
    }
     
    $category = $_POST['category'];
    $price = $_POST['price'];
    //2 return number of products
    $stmt1 =$pdo->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=:product_category AND product_price <= :product_price");
    $stmt1->bindValue(':product_category',$category);
    $stmt1->bindValue(':product_price',$price);

    $stmt1->execute();

    $total_records = $stmt1->fetchColumn();

     //3 products per page

     $total_records_per_page = 8;
     $offset = ($page_no-1) * $total_records_per_page;
 
     $previous_page = $page_no - 1;
     $next_page = $page_no + 1;
 
     $adjacents = "2";
     $total_no_of_pages = ceil($total_records/$total_records_per_page);

    
      // 4 get all products

    $stmt2 =$pdo->prepare("SELECT * FROM products WHERE product_category=:product_category AND product_price<=:product_price LIMIT $offset, $total_records_per_page");
    $stmt2->bindValue(':product_category',$category);
    $stmt2->bindValue(':product_price',$price);

    $stmt2->execute();
    $products = $stmt2->fetchAll(PDO::FETCH_ASSOC);//[]

   

   

   

    // return all products --->
}else{
    //1 determine page number

    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        // if user has already entered page then ppage number is the one that he selected
        $page_no = $_GET['page_no'];
    }else{
        // if user just entered then page default page is 1
        $page_no =1;
    }
    //2 return number of products
    $stmt1 =$pdo->prepare("SELECT COUNT(*) As total_records FROM products ");

    $stmt1->execute();

    $total_records = $stmt1->fetchColumn();
    // $total_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // $products =$stmt->fetchAll(PDO::FETCH_ASSOC);

    //3 products per page

    $total_records_per_page = 8;
    $offset = ($page_no-1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    // 4 get all products

    $stmt2 =$pdo->prepare("SELECT * FROM products  LIMIT $offset, $total_records_per_page");
    $stmt2->execute();
    $main_products = $stmt2->fetchAll(PDO::FETCH_ASSOC);

}


?>

<section class="products">
<div class="product-banner">
            <img src="./images/WALLPAPER.jpg" alt="">
        </div>
    <div class="product-banner container">
       
    <div class="row my-2 py-2"> 
    
            <?php  foreach($main_products as $row):  ?> 
                <div class="product-card  .col-lg-3 col-md-4 col-sm-6">
                <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>">
                    <div class="card-image">
                        <img src="./images/<?php echo $row['product_image1'] ?>" alt="" class="mainImg">
                        <img src="./images/<?php echo $row['product_image2'] ?>" alt="" class="secondImg">
                    </div>
                    <div class="product-name">
                        <h5><?php echo $row['product_name'] ?></h5>
                        <p>$<?php echo $row['price'] ?></p>
                    </div>   
                    </a> 
                </div>              
                <?php endforeach;  ?>         
                             
                              
                              
                             
                             
                            
            </div>
            <div class="pagi" style="position:relative">
        <navs aria-label="Page navigation example" style="text-align:center;">
            <ul class="pagination mt-5">

                <li class="page-item <?php if($page_no<=1){echo 'disabled';} ?>">

                    <a href="<?php if($page_no <=1){echo '#';}else{echo '?page_no='.($page_no-1);} ?>" class="page-link">Previous</a>

                </li>
                <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                <!-- <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li> -->

                <?php if($page_no >=3){ ?>
                <li class="page-item"><a href="#" class="page-link">...</a></li>
                <li class="page-item"><a href="<?php echo '?page_no='.$page_no; ?>" class="page-link"><?php echo $page_no; ?></a></li>
                 <?php   }?>

                <li class="page-item <?php if($page_no>=$total_no_of_pages){echo 'disabled';} ?>">

                    <a href="<?php if($page_no >=$total_no_of_pages){echo '#';}else{echo '?page_no='.($page_no+1);} ?>" class="page-link">Next
                   </a>

                </li>
            </ul>
        </navs>
        </div>
    </div>
</section>




<?php  include('./inc/footer.php')  ?>