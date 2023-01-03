<?php 
session_start();
include('layout/header.php'); 
include('../config/dbcon.php');
?>


<?php   

     



            // 4 get all products
            if(isset($_GET['order_id'])){

                $order_id =  $_GET['order_id'] ?? null;
                if(!$order_id){
                  header('location:index.php');
                 }
     
                 $stmt =$pdo->prepare("SELECT * FROM orders WHERE order_id=:order_id");
                 $stmt->bindValue(':order_id', $order_id);
                 $stmt->execute();
                 $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            } else if(isset($_POST['edit_btn'])){
                    
                $order_status = $_POST['order_status'];
                $order_id = $_POST['order_id'];

                $stmt = $pdo->prepare('UPDATE orders SET order_status =:order_status WHERE order_id=:order_id');
                $stmt->bindValue(':order_status',$order_status);
                $stmt->bindValue(':order_id',$order_id);
                
                
                if($stmt->execute()){
                    header('location:index.php?order_updated=Order has been updated successfully');
                }else{
                    header('location:products.php?order_failed=Error occured, try again');
                }

            } else{
                header('location:index.php');
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
           
          </div>
         
       
          
          
         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Edit Orders</p>
                  <div class="row">
                    
                    <div class="col-md-8">
             
             
              <form action="edit_order.php" method="POST"  class="bord ">
              <?php     
                      $stmt =$pdo->prepare("SELECT * FROM orders WHERE order_id=:order_id");
                      $stmt->bindValue(':order_id', $order_id);
                      $stmt->execute();
                      $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
                     
                     ?>
                       
                           <?php foreach($orders as $r){ ?>
                            <input type="hidden" name="order_id" value="<?php echo $r['order_id'];  ?>">
                        <div class="mb-3">
                            <label  class="form-label">Order Id</label>
                            <p class="my-4"><?php  echo $r['order_id']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Order Price</label>
                            <p class="my-4"><?php  echo $r['order_cost']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Order Status</label>
                            <select  class="form-select" required name="order_status">
                              
                                <option value="not paid"<?php if($r['order_status']=='not paid'){echo 'selected';}?> >Not Paid</option>
                                <option value="paid"<?php if($r['order_status']=='paid'){echo 'selected';}?>> Paid</option>
                                <option value="shipped"<?php if($r['order_status']=='shipped'){echo 'selected';}?>> Shipped</option>
                                <option value="delivered"<?php if($r['order_status']=='delivered'){echo 'selected';}?>> Delivered</option>
                            </select>
                            
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Order Date</label>
                            <p class="my-4"><?php  echo $r['order_date']; ?></p>
                        </div>
                        
                       
                       
                        <button type="submit" class="btn btn-primary"  name="edit_btn">Edit Product</button>

                        <?php }  ?>
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

 <?php  unset($_SESSION['message']);   }?>
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
 