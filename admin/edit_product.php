<?php 
session_start();
include('layout/header.php'); 
include('../config/dbcon.php');
?>


<?php   

     



             // 4 get all products
             if(isset($_GET['product_id'])){
                
                $product_id =  $_GET['product_id'] ?? null;
     
                if(!$product_id){
                 header('location:index.php');
                }
     
                 $stmt =$pdo->prepare("SELECT * FROM products WHERE product_id=:product_id");
                 $stmt->bindValue(':product_id', $product_id);
                 $stmt->execute();
                 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
              
     
                
                 }else if(isset($_POST['edit_btn'])){
     
                     
                 
                     $product_id = $_POST['product_id'];
                     $product_name = $_POST['name'];
                     $product_category = $_POST['category'];
                     $product_description = $_POST['description'];
                     $product_price = $_POST['price'];
                     $product_color = $_POST['color'];
                     $product_stock = $_POST['stock'];
                    
     
     
                            
                     $stmt = $pdo->prepare('UPDATE products SET product_name =:product_name,product_category=:product_category,product_description=:product_description,price=:price,color=:color,stock=:stock WHERE product_id=:product_id');
                     $stmt->bindValue(':product_name',$product_name);
                     $stmt->bindValue(':product_category',$product_category);
                     $stmt->bindValue(':product_description',$product_description);
                     $stmt->bindValue(':price',$product_price);
                     $stmt->bindValue(':color',$product_color);
                     $stmt->bindValue(':stock',$product_stock);
                    
                     $stmt->bindValue(':product_id',$product_id);
                   
                     if($stmt->execute()){
                         header('location:products.php?edit_success_message=Product has been updated successfully');
                     }else{
                         header('location:products.php?edit_failure_message=Error occured, try again');
                     }
     
                     
     
             }else{
                 header('location:products.php');
                 exit;
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
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
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
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Bangalore</h4>
                        <h6 class="font-weight-normal">India</h6>
                      </div>
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
                      <p class="mb-4">Today’s Bookings</p>
                      <p class="fs-30 mb-2">4006</p>
                      <p>10.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Bookings</p>
                      <p class="fs-30 mb-2">61344</p>
                      <p>22.00% (30 days)</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Number of Meetings</p>
                      <p class="fs-30 mb-2">34040</p>
                      <p>2.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Number of Clients</p>
                      <p class="fs-30 mb-2">47033</p>
                      <p>0.22% (30 days)</p>
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
                  <p class="card-title">Edit Product</p>
                  <div class="row">
                    
                    <div class="col-md-8">
              <?php if(isset($_SESSION['message'])) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Hey!</strong> <?=  $_SESSION['message'];?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
              <?php unset($_SESSION['message']); } ?>
                      <form action="edit_product.php" method="POST" enctype="multipart/form-data">
                     <?php     
                      $stmt =$pdo->prepare("SELECT * FROM products WHERE product_id=:product_id");
                      $stmt->bindValue(':product_id', $product_id);
                      $stmt->execute();
                      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                     
                     ?>
                      <?php foreach($products as $row):?>
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id'];  ?>">
                        <div class="mb-3 form-group">
                            <label for="" class="form-label">Product Name</label>
                          <input type="text" name="name" value="<?= $row['product_name'] ?>" placeholder="product category" class="form-control">
                        </div>
                        <div class="mb-3 form-group">
                        <label for="" class="form-label">Product Category</label>
                          <input type="text" name="category" value="<?= $row['product_category'] ?>" placeholder="product category" class="form-control">
                        </div>
                        <div class="mb-3 form-group">
                        <label for="" class="form-label">Product Description</label>
                          <input type="text" name="description" value="<?= $row['product_description'] ?>" placeholder="product description" class="form-control">
                        </div>
                        <div class="mb-3 form-group">
                        <label for="" class="form-label">Product Price</label>
                          <input type="text" name="price" value="<?= $row['price'] ?>" placeholder="product price" class="form-control">
                        </div>
                        <div class="mb-3 form-group">
                        <label for="" class="form-label">Product color</label>
                          <input type="text" name="color" value="<?= $row['color'] ?>" placeholder="product price" class="form-control">
                        </div>
                        <div class="mb-3 form-group">
                        <label for="" class="form-label">Product Stock</label>
                          <input type="text" name="stock" value="<?= $row['stock'] ?>" placeholder="product price" class="form-control">
                        </div>
                        
                        <button name="edit_btn"type="submit" class="pro-btn">Edit Category</button>
                        <?php  endforeach;  ?>
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
        <?php  include('layout/footer.php'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
 

