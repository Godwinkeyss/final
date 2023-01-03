<?php 
session_start();
include('layout/header.php'); 
include('../config/dbcon.php');
?>


<?php   

$stmt =$pdo->prepare("SELECT * FROM contacts ");

$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);



            // 4 get all products
           

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
                  <p class="card-title">All Contact/Complain</p>
                  <div class="row">
                    
                    <div class="col-md-6">
              <?php if(isset($_SESSION['message'])) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Hey!</strong> <?=  $_SESSION['message'];?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
              <?php unset($_SESSION['message']); } ?>
              <?php  foreach ($contacts as $row):   ?>
                    <div class="message">
                        <div class="name">
                            <p>Name</p>
                            <p>Email</p>
                        </div>
                        <div class="name">
                            <p><?php  echo $row['names']  ?></p>
                            <p><?php  echo $row['email']  ?></p>
                        </div>
                        <div class="tracking">
                            <p>Tracking No</p>
                            <p><?php  echo $row['orders']  ?></p>
                        </div>
                        <hr>
                        <div class="comment">
                            <p><?php  echo $row['comment']  ?></p>
                        </div>
                        <div class="date">
                            <p>Date:<?php  echo $row['created_at']  ?></p>
                            <a href="delete_complain.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </div>

                    </div>
                    <?php  endforeach; ?>
                    
                    
             
             
                    </div>
                    <div class="col-md-6">
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
 