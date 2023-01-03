<?php session_start(); ?>

<?php

include('connection.php');


// if user is not logged in
if(!isset($_SESSION['logged_in'])){
   header('location: ../index.php?message=Please login/register to place an order');
     
    exit;
   // if user is logged in
}else{
   


      

    if(isset($_POST['place_order'])){
        // 1. get user info and store it in database

        // $name = $_POST['name'];
        // $username = $_POST['username'];
        $email = $_POST['email'];
      //   $checkbox = $_POST['checkbox'];
        $country = $_POST['country'];
         $first_name = $_POST['first_name'];
         $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $postal = $_POST['postal'];
        $order_cost = $_SESSION['total'];
        $order_status = 'not paid';
        $user_id =$_SESSION['user_id'];
        $order_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
          
      
        $tracking_id = "beast".rand(1111,9999).substr($phone,2);
      // $tracking_id = 123 ;

        $stmt = $pdo->prepare("INSERT INTO orders(order_cost, order_status,user_id,tracking_id,email,country,first_name,last_name,phone,address,postal,state,city,order_date) VALUES(:order_cost,:order_status,:user_id,:tracking_id,:email,:country,:first_name,:last_name,:phone,:address,:postal,:state,:city,:order_date );");
        $stmt->bindValue(':order_cost',$order_cost);
        $stmt->bindValue(':order_status',$order_status);
        $stmt->bindValue(':user_id',$user_id);
        $stmt->bindValue(':tracking_id',$tracking_id);
          $stmt->bindValue(':email',$email);
         //  $stmt->bindValue(':checkbox',$checkbox);
          $stmt->bindValue(':country',$country);
          $stmt->bindValue(':first_name',$first_name);
          $stmt->bindValue(':last_name',$last_name);
          $stmt->bindValue(':phone',$phone);
          $stmt->bindValue(':address',$address);
          $stmt->bindValue(':postal',$postal);
          $stmt->bindValue(':state',$state);
          $stmt->bindValue(':city',$city);
          $stmt->bindValue(':order_date',$order_date);
        
        // $stmt->bindValue(':username',$username);
        
        
         $stmt_status = $stmt->execute();
         if(!$stmt_status){
            header('location:index.php');
            exit;
         }
         $order_id = $pdo->lastInsertId();

         $stmt3 = $pdo->prepare("UPDATE users SET country=:country  WHERE user_id=:user_id ");

         $stmt3->bindValue(':country',$country);
         // $stmt3->bindValue(':user_state',$state);
         $stmt3->bindValue(':user_id',$user_id);
         $stmt3->execute();
   
      // 3.  get product from cart (from session)
      foreach($_SESSION['cart'] as $key => $value){
         $product = $_SESSION['cart'][$key]; // []
         $products_id = $product['product_id'];
         $products_name = $product['product_name'];
         $products_image1 = $product['product_image1'];
         $products_price = $product['product_price'];
         $products_quantity = $product['product_quantity'];

   //       4.store each single item in order_items  database
   //      echo '<prev>';
   //   print_r( $state);
   //   echo '</prev>';
   //   exit;
     
         $stmt1 = $pdo->prepare("INSERT INTO order_items (order_id, product_id,product_name,product_image1,product_price,product_quantity,user_id,order_date) VALUES(:order_id,:product_id,:product_name,:product_image1,:product_price,:product_quantity,:user_id,:order_date)");

         $stmt1->bindValue(':order_id',$order_id);
         $stmt1->bindValue(':product_id',$products_id);
         $stmt1->bindValue(':product_name',$products_name);
         $stmt1->bindValue(':product_image1',$products_image1);
         $stmt1->bindValue(':product_price',$products_price);
         $stmt1->bindValue(':product_quantity',$products_quantity);
         $stmt1->bindValue(':user_id',$user_id);
         $stmt1->bindValue(':order_date',$order_date);

         $stmt1->execute();
      }

       


     

      // 5. remove everything from cart -> delay until payment is done
      // unset($_SESSION['cart']);

      $_SESSION['order_id'] = $order_id;
      // 6. inform user wether everything is fine or there is a problem
      header('Location: ../payment.php?order_status=order placed successfully');
         exit;
      }
   }

?>