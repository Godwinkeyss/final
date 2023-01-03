<?php 
session_start();
include('layout/header.php'); 
include('../config/dbcon.php');

?>


<?php   

     

$product_image1  = '';


             // 4 get all products
             if(isset($_GET['id'])){
                
                $id =  $_GET['id'] ?? null;
     
                if(!$id){
                 header('location:view_homepaper.php');
                }

               
     
                 $stmt =$pdo->prepare("SELECT * FROM wallpapers WHERE id=:id");
                 $stmt->bindValue(':id', $id);
                 $stmt->execute();
                 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
              
     
                
                 }else if(isset($_POST['edit_btn'])){
                    $id = $_POST['id'];
                     $product_name = $_POST['name'];
                    $imagePath = '';
                    $product_image1 = $product_name."1.jpeg";
                    $product_image1 = $_FILES['images'] ?? null;
                 
                     
                     
                     $product_description = $_POST['description'];


                     if($product_image1 && $product_image1['tmp_name']){

                        $imagePath = '../images/'.randomString(8).'/'.$product_image1['name'];
                        mkdir(dirname($imagePath));
                        move_uploaded_file($product_image1['tmp_name'], $imagePath);
                      }
                    
                      if(!$product_image1){
                        $errors[] = 'product image is required';
                    }
                      if(!$product_description){
                        $errors[] = 'product image is required';
                    }
                      if(!$product_name){
                        $errors[] = 'product image is required';
                    }

                                            
                                            
                    if (empty($errors)){
     
                            
                     $stmt = $pdo->prepare('UPDATE wallpapers SET names =:names,description=:description,images=:images WHERE id=:id');
                     $stmt->bindValue(':names',$product_name);
                  
                     $stmt->bindValue(':description',$product_description);
                     $stmt->bindValue(':images',$imagePath);
                    
                     $stmt->bindValue(':id',$id);
                   
                     if($stmt->execute()){
                        //  header('location:index.php?edit_success_message=Wallpaper has been updated successfully');
                     }else{
                         header('location:view_homepaper.php?edit_failure_message=Error occured, try again');
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
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Edit Home Wallpaper</p>
                  <div class="row">
                    
                    <div class="col-md-8">
              <?php if(isset($_SESSION['message'])) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Hey!</strong> <?=  $_SESSION['message'];?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
              <?php unset($_SESSION['message']); } ?>
                      <form action="edit_homepaper.php" method="POST" enctype="multipart/form-data">

                      <?php  if (!empty($errors)):  ?>
                                    <div class="alert alert-danger">
                                        <?php foreach ($errors as $error): ?>
                                            <div><?php echo $error ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif;  ?>
                                  <input type="hidden" name="id" value="<?php echo $id;  ?>">
                                   <input type="hidden" name="product_name" value="<?php echo $product_name  ?>">
                     <?php     
                      $stmt =$pdo->prepare("SELECT * FROM wallpapers WHERE id=:id");
                      $stmt->bindValue(':id', $id);
                      $stmt->execute();
                      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                     
                     ?>
                      <?php foreach($products as $row):?>
                        <input type="hidden" name="id" value="<?php echo $row['id'];  ?>">
                        <div class="mb-3 form-group">
                           
                         <img src="../images/<?php echo $row['images'];  ?>" alt=""  style="width:200px;height:200px;object-fit:cover;" name="">
                        </div>
                        <div class="mb-3 form-group">
                            <label for="" class="form-label">Title</label>
                          <input type="text" name="name" value="<?= $row['names'] ?>" placeholder="product category" class="form-control">
                        </div>
                        <div class="mb-3 form-group">
                        <label for="" class="form-label"> Description</label>
                        <textarea name="description" id="" cols="30" rows="10"placeholder="Description"class="form-control"><?= $row['description'] ?></textarea>
                          
                        </div>
                        <div class="mb-3 form-group">
                          <input type="file" name="images" class="form-control">
                          
                      </div>

                        
                       
                        <button name="edit_btn"type="submit" class="pro-btn">Edit Wallpaper</button>
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
 

