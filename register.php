<?php  include('inc/header.php') ?>



<!-- <section id="register" class="my-5 py-5">

   <div class="row justify-content-center my-5 py-5">
    <div class="col-md-4">
        <div class="register">
            <div class="register-heading text-center">
                <h1>Create Account</h1>
            </div>
            <?php if(isset($_SESSION['message'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?=  $_SESSION['message'];?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['message']); } ?>
            <div class="register-body">
            <form action="functions/authcode.php" method="POST">
                <div class="mb-3 form-group">
                 
                    <input type="text"name="first_name" class="form-control" placeholder="Enter your first name">
                </div>
                <div class="mb-3 form-group">
               
                    <input type="text"name="last_name" class="form-control" placeholder="Enter your last name">
                </div>
                <div class="mb-3 form-group">
               
                    <input type="text"name="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="mb-3 form-group">
                
                    <input type="number"name="phone" class="form-control" placeholder="Enter your phone number">
                </div>
                <div class="mb-3 form-group">
            
                    <input type="password"name="password" class="form-control" placeholder="Enter your password">
                </div>
                <div class="mb-3 form-group">
               
                    <input type="password"name="confirm" class="form-control" placeholder="Confirm password">
                </div>
                <button type="submit" name="register" class="btn btn-primary">Sign Up</button>
            </div>
            </form>
        </div>
    </div>
   </div>
</section> -->
<div class=" my-5 py-5">
    <h1 class="text-center fs1 my-4 py-4 fw-light">Create account</h1>
    <div class="login d-flex align-items-center justify-content-center ">
        <form action="functions/authcode.php" method="POST" class="">
        <?php if(isset($_SESSION['message'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?=  $_SESSION['message'];?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
         <?php unset($_SESSION['message']); } ?>
            <input type="text"name="first_name" placeholder="First name" class=""required>
            <input type="text"name="last_name" placeholder="Last name" class=""required>
            <input type="text"name="email" placeholder="Email" class=""required>
            <input type="number"name="phone" placeholder="Phone number" class=""required>
            <br>
            <input type="password"name="password" placeholder="Password" class=""required>
            <input type="password"name="confirm" placeholder="Confirm Password" class=""required>
            <div class="create-acc">
            <p class="create text-center">already have an account? </p>
            <a href="login.php" class="cre">Login</a>
            </div>
            <!-- <p><a href=""> Forgot your password?</a></p> -->
            <span class="underline"></span>
            <button name="register" type="submit">Sign in</button>

          
            <!-- <hr> -->
        </form>
       
    </div>
    
    
</div>
<?php  include('inc/footer.php') ?>