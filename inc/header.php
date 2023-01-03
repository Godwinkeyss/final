<?php session_start();
    
//  $_SESSION['cart'] = 22;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css"  />
    <link rel="stylesheet" href="./css/style3.css"  />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
   <!-- navbar start -->
<nav class="navbar navbar-expand-lg bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand fs-1 logo" href="index.php">SLAYBEAST</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active g" aria-current="page" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                <a class="nav-link g" href="products.php">PRODUCTS</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link g" href="contact.php">CONTACT</a>
                </li>
            
            
            </ul>
            <ul class="navbar-nav  mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="account.php"><i class="fa-regular fa-user"style="font-size:20px"></i></a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link" href="carts.php">
                            <i class="fa-solid fa-bag-shopping cart "style="font-size:20px">
                             <?php if(isset($_SESSION['cart'])) { ?>
                                <span class="cart-quantity"style="background:red;color:white;border-radius:50%;padding:3px 6px;font-size:12px;position:absolute;top:28px"><?php echo count($_SESSION['cart']);  ?></span>

                                
                            <?php } ?>
                            </i>
                            <!-- echo '<prev>';
                             print_r( $_SESSION['cart']);
                             echo '</prev>'; -->
                        </a>
            
                
                </li>
            </ul>
            </div>
        </div>
</nav>
<!-- navbar end -->
