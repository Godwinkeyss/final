<?php 
include('layout/header.php'); 
include('../config/dbcon.php');
?>


<?php   
 $errors = [];


 $product_name= '';
 $product_category = '';
 $product_description='';
 $product_price = '';
 $product_image1  = '';
 $product_image2  = '';
 $product_image3  = '';
 $product_image4  = '';
 $product_color  = '';
 $product_stock  = '';
if($_SERVER['REQUEST_METHOD'] ==='POST'){
// if(isset($_POST['submit'])){
$product_name = $_POST['product_name'];
$product_category = $_POST['category'];
$product_description = $_POST['description'];
$product_price = $_POST['price'];
$product_stock = $_POST['stock'];
$product_color = $_POST['color'];


    // $product_image = $_FILES['image1']['name'] ?? null;
    // $product_image2 = $_FILES['image2']['name'] ?? null;
    // $product_image3 = $_FILES['image3']['name'] ?? null;
    // $product_image4 = $_FILES['image4']['name'] ?? null;


    // $product_tmp_image = $_FILES['image1']['tmp_name']?? null;
    // $product_tmp_image2 = $_FILES['image2']['tmp_name']?? null;
    // $product_tmp_image3 = $_FILES['image3']['tmp_name']?? null ;
    // $product_tmp_image4 = $_FILES['image4']['tmp_name']?? null;


    $product_image1 = $product_name."1.jpeg";
    $product_image2 = $product_name."2.jpeg";
    $product_image3 = $product_name."3.jpeg";
    $product_image4 = $product_name."4.jpeg";



if(!$product_name){
   $errors[] = 'product name is required';
}

if(!$product_category){
    $errors[] = 'product category is required';
}
if(!$product_description){
    $errors[] = 'product description is required';
}
if(!$product_price){
    $errors[] = 'product price is required';
}
// if(!$product_stock){
//     $errors[] = 'product stock is required';
// }
if(!$product_color){
    $errors[] = 'product color is required';
}
if(!$product_image1){
    $errors[] = 'product image is required';
}
if(!$product_image2){
    $errors[] = 'product image is required';
}
if(!$product_image3){
    $errors[] = 'product image is required';
}
if(!$product_image4){
    $errors[] = 'product image is required';
}

if (!is_dir('images')){
    mkdir('images');
}

 if (empty($errors)){
    
    $imagePath = '';
    $imagePath2 = '';
    $imagePath3 = '';
    $imagePath4 = '';

    $product_image1 = $_FILES['image1'] ?? null;
    $product_image2 = $_FILES['image2'] ?? null;
    $product_image3 = $_FILES['image3'] ?? null;
    $product_image4 = $_FILES['image4'] ?? null;

    if($product_image1 && $product_image1['tmp_name']){

      $imagePath = '../images/'.randomString(8).'/'.$product_image1['name'];
      mkdir(dirname($imagePath));
      move_uploaded_file($product_image1['tmp_name'], $imagePath);
    }
    if($product_image2 && $product_image2['tmp_name']){

      $imagePath2 = '../images/'.randomString(8).'/'.$product_image2['name'];
      mkdir(dirname($imagePath2));
      move_uploaded_file($product_image2['tmp_name'], $imagePath2);
    }
   
    if($product_image3 && $product_image3['tmp_name']){

      $imagePath3 = '../images/'.randomString(8).'/'.$product_image3['name'];
      mkdir(dirname($imagePath3));
      move_uploaded_file($product_image3['tmp_name'], $imagePath3);
    }
    
    if($product_image4 && $product_image4['tmp_name']){

      $imagePath4 = '../images/'.randomString(8).'/'.$product_image4['name'];
      mkdir(dirname($imagePath4));
      move_uploaded_file($product_image4['tmp_name'], $imagePath4);
    }
    
    
   

    
$stmt = $pdo->prepare("INSERT INTO products (product_name,product_category,product_description,product_image1,product_image2,product_image3,product_image4,price,color,stock) VALUES(:product_name,:product_category,:product_description,:product_image1,:product_image2,:product_image3,:product_image4,:price,:color,:stock)");

$stmt->bindValue(':product_name', $product_name);
$stmt->bindValue(':product_category', $product_category);
$stmt->bindValue(':product_description', $product_description);
$stmt->bindValue(':product_image1', $imagePath);
$stmt->bindValue(':product_image2', $imagePath2);
$stmt->bindValue(':product_image3',  $imagePath3);
$stmt->bindValue(':product_image4',$imagePath4);
$stmt->bindValue(':price', $product_price);
$stmt->bindValue(':color',$product_color);
$stmt->bindValue(':stock', $product_stock);

if($stmt->execute()){
  $_SESSION['message'] = 'Product has been added successfully';
    header('location:products.php?product_added=Product has been added successfully');
}else{
    $_SESSION['message'] = 'Error occured, try again';
    header('location:products.php?product_failed=Error occured, try again');
}
}

}

function randomString($n){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for($i = 0; $i < $n; $i++){
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}
?>

<?php   

     
// get orders


//1 determine page number

if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
    // if user has already entered page then ppage number is the one that he selected
    $page_no = $_GET['page_no'];
}else{
    // if user just entered then page default page is 1
    $page_no =1;
}
//2 return number of products
$stmt1 =$pdo->prepare("SELECT COUNT(*) As total_records FROM categories ");

$stmt1->execute();

$total_records = $stmt1->fetchColumn();
// $total_records = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $products =$stmt->fetchAll(PDO::FETCH_ASSOC);

//3 products per page

$total_records_per_page = 10;
$offset = ($page_no-1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$adjacents = "2";
$total_no_of_pages = ceil($total_records/$total_records_per_page);

// 4 get all products

$stmt2 =$pdo->prepare("SELECT * FROM categories  LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$categories = $stmt2->fetchAll(PDO::FETCH_ASSOC);



?>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php include('layout/sidebar.php')  ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Add product</h3>
                </div>
                
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="images/dashboard/people.svg" alt="people">
                 
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Today’s Quote</p>
                      <p class="fs-30 mb-2">Great </p>
                     
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Today's Quote</p>
                      <p class="fs-30 mb-2">Success</p>
                
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Today's Quote</p>
                      <p class="fs-30 mb-2">Sweet</p>
                     
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                    <p class="mb-4">Today's Quote</p>
                      <p class="fs-30 mb-2">Sales</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
       
          
          
         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Add product</p>
                  <div class="row">
                  <?php  if (!empty($errors)):  ?>
                                    <div class="alert alert-danger">
                                        <?php foreach ($errors as $error): ?>
                                            <div><?php echo $error ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif;  ?>
                    <div class="col-md-8">
                      <form action="add_product.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3 form-group">
                          <input type="text" name="product_name" placeholder="product name" class="form-control"  value="<?php echo $product_name ?>">
                        </div>
                       
                        <div class="mb-3 form-group">
                        <select class="form-select form-select-lg mb-3 w-100"name="category" aria-label=".form-select-lg example">
                        <option selected>Categories</option>
                          <?php foreach($categories as $row):  ?>
                            <option value="<?= $row['category_name']  ?>"><?= $row['category_name']  ?></option>
                          <?php endforeach;  ?>
                          </select>
                        </div>
                        <div class="mb-3 form-group">
                          <textarea name="description" id="" cols="30" rows="10"placeholder="product description"  style="width:100%;height:100px;padding:10px 20px;"><?php echo $product_description?></textarea>
                          <!-- <input type="text"name="description"  class="form-control"> -->
                        </div>
                        
                        <div class="mb-3">
                          <label  class="form-label files">product image</label><br>
                          <input type="file" name="image1" class="form-control ">
                        </div>
                        <div class="mb-3">
                          <label  class="form-label files">product image2</label><br>
                          <input type="file" name="image2"class="form-control ">
                        </div>
                        <div class="mb-3">
                          <label  class="form-label files">product image3</label><br>
                          <input type="file" name="image3"class="form-control ">
                        </div>
                        <div class="mb-3">
                          <label  class="form-label files">product image4</label><br>
                          <input type="file" name="image4"class="form-control ">
                        </div>
                        <div class="mb-3 form-group">
                          <input type="number" name="price"value="<?php echo $product_price?>" placeholder="price" class="form-control">
                        </div>
                        <div class="mb-3 form-group">
                          <input type="text"name="color"value="<?php echo $product_color?>" placeholder="color" class="form-control">
                        </div>
                        <div class="mb-3 form-group">
                          <input type="number"name="stock"value="<?php echo $product_stock?>" placeholder="stock" class="form-control">
                        </div>
                        
                        <button name="submit" class="pro-btn">Add Product</button>
                      </form>
                    </div>
                    <div class="col-md-4">
                      <img src="./images/dashboard/people.png" alt="" width="100%" height="50%" style="object-fit:cover;">
                    </div>
                    
                  </div>
                  </div>
                </div>

                
              </div>
            </div>
        </div>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
 <?php if(isset($_SESSION['message'])) {  ?>
 alertify.set('notifier','position', 'top-right');
alertify.success('<?php echo $_SESSION['message']  ?>');

<?php unset($_SESSION['message']);   }?>

</script>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php  include('layout/footer.php'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  
 