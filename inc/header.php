<?php session_start();  ?>

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
<!-- <nav class="navbar navbar-expand-lg bg-light fixed-top shadow">
        <div class="container">
            <a class="navbar-brand fs-1 logo" href="index.php">SLAYBEAST</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="products.php">PRODUCTS</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">ABOUT</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">CONTACT</a>
                </li>
            
            
            </ul>
            <ul class="navbar-nav  mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="account.php">ACCOUNT</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="carts.php">
                            <i class="fa-solid fa-bag-shopping cart "style="font-size:20px">
                             <?php if(isset($_SESSION['cart'])) { ?>
                                <span class="cart-quantity"style="background:red;color:white;border-radius:50%;padding:3px 6px;font-size:12px;position:absolute;top:28px"><?php echo count($_SESSION['cart']);  ?></span>

                                
                            <?php } ?>
                            </i>
                          
                        </a>
            
                
                </li>
            </ul>
            </div>
        </div>
</nav> -->
<header class="headers">
        <nav class="navs">
            <div class="left">
                <div class="bug">
                    <span class="bars"></span>
                    <span class="bars"></span>
                    <span class="bars"></span>
                </div>
                <h1><a href="index.php"> SLAYBEAST</a> </h1>
           </div>
            <div class="center">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="products.php">PRODUCTS</a></li>
                    <!-- <li><a href="">ABOUT</a></li> -->
                    <li><a href="contact.php">CONTACT</a></li>
                    <li class="reg regs"><a href="account.php">REGISTER</a></li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li class="reg"><a href="account.php"><i class="fa-regular fa-user bag"></i></a></li>
                    <li><a href="show_wishlist.php"><i class="fa-regular fa-heart bag"></i></a></li>
                    <li><a href="carts.php"><i class="fa-solid fa-bag-shopping cart">
                    <?php if(isset($_SESSION['cart'])) { ?>
                                <span class="cart-quantity"style="background:red;color:white;border-radius:50%;padding:3px 6px;font-size:12px;position:absolute;top:28px"><?php echo count($_SESSION['cart']);  ?></span>

                                
                            <?php } ?>
                    </i></a></li>
                </ul>
            </div>
         </nav>
    </header>



    <script>
        let center = document.querySelector('.center')
let bug = document.querySelector('.bug')

bug.addEventListener('click',()=>{
    bug.classList.toggle('active');
    center.classList.toggle('active');
})

    </script>
<!-- navbar end -->
