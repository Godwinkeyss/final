<?php  include('./inc/header.php')  ?>

<?php
 include('./server/connection.php');

if($_SERVER['REQUEST_METHOD'] ==='POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $order = $_POST['order'];
    $comment = $_POST['comment'];
    $order_date = date('Y-m-d H:i:s');

    $stmt = $pdo->prepare("INSERT INTO contacts (names,email,orders,comment,created_at) VALUES(:names,:email,:orders,:comment,:created_at)");
     $stmt->bindValue(':names',$name);
     $stmt->bindValue(':email',$email);
     $stmt->bindValue(':orders',$order);
     $stmt->bindValue(':comment',$comment);
     $stmt->bindValue(':created_at',$order_date);

     if($stmt->execute()>0){
        $_SESSION['message'] = "Your complain is noted";
        header('location:contact.php?complain_recorded=Your complain is noted');
     }else{
        $_SESSION['message'] = "Error occured please try again!";
        header('location:contact.php?complain_failed=Error occured please try again!');
     }

}


?>
<body>
    <div class="contact-img">
        <img src="./images/WALLPAPER.jpg" alt="">
    </div>
    <div class="contact-us-div mt-md-5">
        <h1 class="mb-4">Contact Us</h1>
        <p class="please">Need help? Our Beast Team is here for you!</p>
        <p>Please allow up to 48 hours (Not including weekends and holidays) to receive a response.</p>
        <p><span><a href="returns_exchange.php">Click here</a> </span>  for more information on returns/exchanges.</p>
    </div>
    <div class="contact-div mb-5">
        <form action="contact.php" method="POST">
        <?php if(isset($_SESSION['message'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?=  $_SESSION['message'];?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
         <?php unset($_SESSION['message']); } ?>
            <div class="form-group  split">
                <input type="text" placeholder="name" name="name" class="">
                <input type="text" placeholder="email" name="email" class="">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Tracking/Order Number" name="order" class="">
            </div>
            <div class="form-group">
                <textarea name="comment" id="" cols="30" rows="10" placeholder="Comment"></textarea>
            </div>
            <button name="send" type="submit">Send</button>
        </form>
    </div>
    <?php  include('./inc/footer.php')  ?>