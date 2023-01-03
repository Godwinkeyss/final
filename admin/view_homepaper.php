<?php
  session_start();
include('layout/header.php');
include('../config/dbcon.php');

?>
<?php   

     
// get orders


//1 determine page number



$stmt2 =$pdo->prepare("SELECT * FROM wallpapers  LIMIT 1");
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
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
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
                  <p class="card-title">Home Wallpaper</p>
                  <div class="row">
                    <div class="col-12">
                    <?php if(isset($_SESSION['message'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Hey!</strong> <?=  $_SESSION['message'];?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php unset($_SESSION['message']); } ?>
                      <div class="table-responsive">
                        <table id="example" class="display expandable-table" style="width:100%">
                          <thead>
                            <tr>
                                  <th>ID</th>
                                    <th>Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                    
                             
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach( $products as $product): ?>
                            <tr>
                            <th scope="row"data-title="Product Id"><?php echo $product['id']; ?></th>
                            <td data-title="Product Name"><?php echo $product['names']; ?></td>
                                    <td data-title="Product Image"><img src="../images/<?php echo $product['images']; ?>" style="width:70px; height:70px;object-fit:cover;"></td>
                                    
                                    <td data-title="Product Price">₦<?php echo $product['description']; ?></td>
                                   
                                    
                                    <td data-title="Edit"><a href="edit_homepaper.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                    
                                    <td data-title="Delete"><a href="delete_homepaper.php?product_id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                           
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
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
 
