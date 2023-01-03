<?php 
session_start();
include('layout/header.php'); 
include('../config/dbcon.php');
?>


<?php   
 $errors = [];



 $category = '';
 
if($_SERVER['REQUEST_METHOD'] ==='POST'){
// if(isset($_POST['submit'])){

$category = $_POST['category'];


if(!$category){
    $errors[] = 'product category is required';
    $_SESSION['message'] = "Product category is required ";
}


 if (empty($errors)){
    
    
   

    
$stmt = $pdo->prepare("INSERT INTO categories (category_name) VALUES(:category_name)");

$stmt->bindValue(':category_name', $category);


if($stmt->execute()){
  $_SESSION['message'] = "Category has been added successfully ";
    header('location:categories.php?product_added=Product has been added successfully');
}else{
  $_SESSION['message'] = "Error occured, try again ";

    header('location:add_category.php?product_failed=Error occured, try again');
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
                  <p class="card-title">Add Category</p>
                  <div class="row">
                    
                    <div class="col-md-8">
              <!-- <?php if(isset($_SESSION['message'])) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Hey!</strong> <?=  $_SESSION['message'];?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
              <?php unset($_SESSION['message']); } ?> -->
                      <form action="add_category.php" method="post" enctype="multipart/form-data">
                       
                        <div class="mb-3 form-group">
                          <input type="text" name="category" placeholder="product category" class="form-control">
                        </div>
                        
                        <button name="submit" class="pro-btn">Add Category</button>
                      </form>
                    </div>
                    <div class="col-md-4">
                      <img src="./images/dashboard/people.png" alt="" width="100%" height="100%" style="object-fit:cover;">
                    </div>
                    
                  </div>
                  </div>
                </div>

                
              </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
  // <?php if(isset($_SESSION['message'])) {  ?>
   alertify.set('notifier','position', 'top-right');
alertify.success('<?php echo $_SESSION['mesaage']  ?>');
//  <?php    }?>
</script>
        <?php  include('layout/footer.php'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
 