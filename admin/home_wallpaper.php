<?php 
include('layout/header.php'); 
include('../config/dbcon.php');
?>


<?php   
 $errors = [];



 $product_description='';
 $title='';

 $product_image1  = '';


if($_SERVER['REQUEST_METHOD'] ==='POST'){
// if(isset($_POST['submit'])){

$title = $_POST['name'];
$description = $_POST['description'];



   


    $product_image1 = $product_name."1.jpeg";
 






if (!is_dir('images')){
    mkdir('images');
}

 if (empty($errors)){
    
    $imagePath = '';
   

    $product_image1 = $_FILES['image1'] ?? null;
  

    if($product_image1 && $product_image1['tmp_name']){

      $imagePath = '../images/'.randomString(8).'/'.$product_image1['name'];
      mkdir(dirname($imagePath));
      move_uploaded_file($product_image1['tmp_name'], $imagePath);
    }
   
    
    
   

    
$stmt = $pdo->prepare("INSERT INTO wallpapers (names,description,images) VALUES(:names,:description,:images)");


$stmt->bindValue(':names', $title);
$stmt->bindValue(':description', $description);
$stmt->bindValue(':images', $imagePath);

if($stmt->execute()){
    header('location:view_homepaper.php?wallpaper_added=Wallpaper has been added successfully');
}else{
    header('location:home_wallpaper.php?wallpaper_failed=Error occured, try again');
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
$stmt1 =$pdo->prepare("SELECT COUNT(*) As total_records FROM wallpapers ");

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

$stmt2 =$pdo->prepare("SELECT * FROM wallpapers  LIMIT $offset, $total_records_per_page");
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
                  <p class="card-title">Add Wallpaper @ Home Page</p>
                  <div class="row">
                    
                    <div class="col-md-8">
                      <form action="home_wallpaper.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3 form-group">
                           <input type="text" name="name" placeholder="Title" class="form-control">
                        </div>
                        <div class="mb-3 form-group">
                         
                          <textarea name="description"  class="form-control" id="" cols="30" rows="10" placeholder="Description"></textarea>
                        </div>
                       
                       
                       
                        
                        <div class="mb-3">
                          <label  class="form-label files">product image</label><br>
                          <input type="file" name="image1" class="form-control ">
                        </div>
                        
                        
                        
                        <button name="submit" class="pro-btn">Add Wallpaper</button>
                      </form>
                    </div>
                    <div class="col-md-4">
                      <img src="./images/dashboard/people.png" alt="" width="100%" height="50%" style="object-fit:cover;">
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
  
