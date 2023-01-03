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
                  <h3 class="font-weight-bold">Welcome Admin</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
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
                  <p class="card-title">All categories</p>
                  <div class="row">
                    <div class="col-12">
                   

                      <div class="table-responsive">
                        <table  class="table table-striped table-borderless" style="width:100%">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                             
                              <th>Edit</th>
                              <th>Delete</th>
                              
                             
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach( $categories as $row): ?>
                            <tr>
                           
                            <td><?= $row['category_id'];  ?></td>
                            <td><?= $row['category_name'];  ?></td>
                            <td><a href="edit_categories.php?category_id=<?php echo $row['category_id']; ?>"  class="edit " name="">Edit</button ></a>
                            <td><a href="delete_categories.php?category_id=<?php echo $row['category_id']; ?>" class="delete">Delete</a></td>
                            
                            
                           
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
    alertify.set('notifier','position', 'top-right');
 alertify.success('<?php  echo $_SESSION['message'] ?>');
    <?php if(isset($_SESSION['message'])): ?>
      unset($_SESSION['message']);
 <?php endif;?>
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
 
 