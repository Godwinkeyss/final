<?php 
session_start();
include('layout/header.php'); 
include('../config/dbcon.php');
?>


<?php   

     



            // 4 get all products
            if(isset($_GET['category_id'])){
                
           $category_id =  $_GET['category_id'] ?? null;

           if(!$category_id){
            header('location:index.php');
           }

            $stmt =$pdo->prepare("SELECT * FROM categories WHERE category_id=:category_id");
            $stmt->bindValue(':category_id', $category_id);
            $stmt->execute();
            $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
         

           
            }else if(isset($_POST['edit_btn'])){

                
            
                $category_id = $_POST['category_id'];
                $category_name = $_POST['category'];
                


                       
                $stmt = $pdo->prepare('UPDATE categories SET category_name =:category_name WHERE category_id=:category_id');
                $stmt->bindValue(':category_name',$category_name);
               
                $stmt->bindValue(':category_id',$category_id);
              
                if($stmt->execute()){
                    $_SESSION['message'] = "Category has been updated successfully";
                    header('Location:categories.php?edit_success_message=Product has been updated successfully');
                }else{
                    $_SESSION['message'] = "Error occured, try again";
                    header('location:edit_categories.php?edit_failure_message=Error occured, try again');
                }

                

        }else{
            header('location:categories.php');
            exit;
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
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Edit Category</p>
                  <div class="row">
                    
                    <div class="col-md-8">
             
                      <form action="edit_categories.php" method="POST" enctype="multipart/form-data">
                     <?php     
                      $stmt =$pdo->prepare("SELECT * FROM categories WHERE category_id=:category_id");
                      $stmt->bindValue(':category_id', $category_id);
                      $stmt->execute();
                      $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
                     
                     ?>
                      <?php foreach($product as $row):?>
                        <input type="hidden" name="category_id" value="<?php echo $row['category_id'];  ?>">
                        <div class="mb-3 form-group">
                          <input type="text" name="category" value="<?= $row['category_name'] ?>" placeholder="product category" class="form-control">
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
 
 