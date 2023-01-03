<?php 
session_start();
include('layout/header.php'); 
include('../config/dbcon.php');
?>

<?php

$stmt = $pdo->prepare('SELECT * FROM countries');
$stmt->execute();
$country =$stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $pdo->prepare('SELECT * FROM states');
$stmt2->execute();
$states =$stmt2->fetchAll(PDO::FETCH_ASSOC);


$countrys = '';
$city = '';
$price = '';


if($_SERVER['REQUEST_METHOD'] ==='POST'){
// if(isset($_POST['submit'])){

$countrys = $_POST['countries'];
$city = $_POST['city'];
$price = $_POST['price'];
$stmt = $pdo->prepare("INSERT INTO shipping (country_name,country_state, price) VALUES(:country_name,:country_state,:price) ");

$stmt->bindValue(':country_name', $countrys);
$stmt->bindValue(':country_state', $city);
$stmt->bindValue(':price', $price);
if($stmt->execute()){
  $_SESSION['message'] = "Shipping price has been added successfully ";

    // header('Location:shipping.php');
}else{
   $_SESSION['message'] = "Error occured, try again ";

    header('Location:add_shipping.php?product_failed=Error occured, try again');
}
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
                  <p class="card-title">Add Shipping price</p>
                  <div class="row">
                    
                    <div class="col-md-8">
              
              <form action="add_shipping.php" method="POST" >    
                               
                               <div class="input-group mb-3">
                                   <!-- <label class="input-group-text" for="inputGroupSelect01">Country</label> -->
                                   <select class="form-select"style="width:100%;" id="inputGroupSelect01"name="countries"onchange="enablecity(this)">
                                       <option selected>Country</option>
                                       <?php  foreach($country as $row):  ?>
                                       <option value="<?php echo $row['country_name'];  ?>" ><?php echo $row['country_name']  ?></option>
                                       <?php   endforeach;  ?>
                                      
                                   </select>
                                    
                               </div>
                               <div class="input-group mb-3">
                                   <!-- <label class="input-group-text " for="city">States</label> -->
                                   <select class="form-select d-bloc"style="width:100%;"  id="city"name="city">
                                       <option selected>States</option>
                                       <?php  foreach($states as $row):  ?>
                                       <option value="<?php echo $row['state_name'];  ?>" name="state"><?php echo $row['state_name']  ?></option>
                                       <?php   endforeach;  ?>
                                      
                                   </select>
                                    
                               </div>
                               <div class="mb-3">
                                               <label  class="form-label">Shipping Price</label>
                                               <input type="text" name="price" value="" class="form-control">
                                           </div>
                                <button type="submit "class="pro-btn" name="submit">Submit</button>
           
           
           
           
           
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
   <?php if(isset($_SESSION['message'])) {  ?>
   alertify.set('notifier','position', 'top-right');
alertify.success('<?php echo $_SESSION['message']  ?>');
 <?php  unset($_SESSION['message']);    }?>
</script>
<!-- FOOT -->
        <?php  include('layout/footer.php'); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script type="text/javascript">

function enablecity(answer){
 console.log(answer.value)
 if(answer.value === 'United Kingdom'){
     document.getElementById('city').classList.add('d-bloc')
     document.getElementById('city').classList.remove('d-none')
 }else if(answer.value !== 'Nigeria'){
    document.getElementById('city').classList.add('d-none')
    document.getElementById('city').classList.remove('d-bloc')
 }
}
</script>