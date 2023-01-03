<?php
  session_start();
include('layout/header.php');
include('../config/dbcon.php');

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
$stmt1 =$pdo->prepare("SELECT COUNT(*) As total_records FROM products ");

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

$stmt2 =$pdo->prepare("SELECT * FROM products  LIMIT $offset, $total_records_per_page");
$stmt2->execute();
$products = $stmt2->fetchAll(PDO::FETCH_ASSOC);



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
                  <h3 class="font-weight-bold">Welcome Admin</h3>
                </div>
                
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="images/dashboard/people.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      
                      
                    </div>
                  </div>
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
                  <p class="card-title">Advanced Table</p>
                  <div class="row">
                    <div class="col-12">
                 
                      <div class="table-responsive">
                        <table id="example" class="display expandable-table" style="width:100%">
                          <thead>
                            <tr>
                                  <th>ID</th>
                                    <th>Product Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Product Stock</th>
                                    <th scope="col">Product Category</th>
                                    <th scope="col">Product Color</th>
                                    <th scope="col">Edit Images</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach( $products as $product): ?>
                            <tr>
                            <th scope="row"data-title="Product Id"><?php echo $product['product_id']; ?></th>
                                    <td data-title="Product Image"><img src="../images/<?php echo $product['product_image1']; ?>" style="width:70px; height:70px;object-fit:cover;"></td>
                                    <td data-title="Product Name"><?php echo $product['product_name']; ?></td>
                                    <td data-title="Product Price">£<?php echo $product['price']; ?></td>
                                    <td data-title="Product Offer"><?php echo $product['stock']; ?></td>
                                    <td data-title="Product Category"><?php echo $product['product_category']; ?></td>
                                    <td data-title="Product Color"><?php echo $product['color']; ?></td>
                                   
                                    <td data-title="Edit Images"><a href="<?php echo "edit_images.php?product_id=".$product['product_id']."&product_name=".$product['product_name']; ?>" class="btn  btn-sm btn-warning">Edit Images</a></td>
                                    
                                    <td data-title="Edit"><a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                    
                                    <td data-title="Delete"><a href="delete_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                           
                            </tr>
                            <?php endforeach;   ?>
                            
                          </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>

                
              </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php  include('layout/footer.php'); ?>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
   <?php if(isset($_SESSION['message'])) {  ?>
   alertify.set('notifier','position', 'top-right');
alertify.success('<?php echo $_SESSION['message']  ?>');

 <?php  unset($_SESSION['message']);   }?>
</script>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
 
