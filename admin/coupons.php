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

            $stmt2 =$pdo->prepare("SELECT * FROM coupons  LIMIT $offset, $total_records_per_page");
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
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Add Coupons</p>
                  <div class="row">
                    <div class="col-12">
                 
                      <div class="table-responsive">
                        <table  class="table table-striped table-borderless" style="width:100%">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Coupon Code</th>
                              <th>Discount percent</th>
                             
                              <th>Edit</th>
                              <th>Delete</th>
                              
                             
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach( $categories as $row): ?>
                            <tr>
                           
                            <td><?= $row['id'];  ?></td>
                            <td><?= $row['coupon'];  ?></td>
                            <td><?= $row['discount'];  ?></td>
                            <td><a href="edit_coupon.php?id=<?php echo $row['id']; ?>"  class="edit " name="">Edit</button ></a>
                            <td><a href="delete_coupon.php?id=<?php echo $row['id']; ?>" class="delete">Delete</a></td>
                            
                            
                           
                            </tr>
                            <?php endforeach;  ?>
                            
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
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
   <?php if(isset($_SESSION['message'])) {  ?>
   alertify.set('notifier','position', 'top-right');
alertify.success('<?php echo $_SESSION['message']  ?>');
unset($_SESSION['message']);
 <?php    }?>
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
 