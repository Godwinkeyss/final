<?php

 include('../server/connection.php');  

 if(isset($_POST['update_images'])){
    $product_name = $_POST['product_name'];
    $product_id = $_POST['product_id'];

$stmt = $pdo->prepare('SELECT * FROM products WHERE product_id = :product_id');
$stmt->bindValue(':product_id',$product_id);
$stmt->execute();
$product =$stmt->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($product);
// echo '<pre>';
// exit;

$imagePath = $product['product_image1'];
    $imagePath2 = $product['product_image2'];
    $imagePath3 = $product['product_image3'];
    $imagePath4 = $product['product_image4'];


        $product_image1 = $product_name."1.jpeg";
        $product_image2 = $product_name."2.jpeg";
        $product_image3 = $product_name."3.jpeg";
        $product_image4 = $product_name."4.jpeg";


    $product_image1 = $_FILES['image1'] ?? null;
    $product_image2 = $_FILES['image2'] ?? null;
    $product_image3 = $_FILES['image3'] ?? null;
    $product_image4 = $_FILES['image4'] ?? null;

   

    if($product_image1 && $product_image1['tmp_name']){

        if($product['product_image1']){
            unlink($product['product_image1']);
        }

      $imagePath = '../images/'.randomString(8).'/'.$product_image1['name'];
      mkdir(dirname($imagePath));
      move_uploaded_file($product_image1['tmp_name'], $imagePath);
    }


    
    if($product_image2 && $product_image2['tmp_name']){

        if($product['product_image2']){
            unlink($product['product_image2']);
        }

      $imagePath2 = '../images/'.randomString(8).'/'.$product_image2['name'];
      mkdir(dirname($imagePath2));
      move_uploaded_file($product_image2['tmp_name'], $imagePath2);
    }

    

    
   
    if($product_image3 && $product_image3['tmp_name']){

        if($product['product_image3']){
            unlink($product['product_image3']);
        }

      $imagePath3 = '../images/'.randomString(8).'/'.$product_image3['name'];
      mkdir(dirname($imagePath3));
      move_uploaded_file($product_image3['tmp_name'], $imagePath3);
    }
    
    if($product_image4 && $product_image4['tmp_name']){

        if($product['product_image4']){
            unlink($product['product_image4']);
        }

      $imagePath4 = '../images/'.randomString(8).'/'.$product_image4['name'];
      mkdir(dirname($imagePath4));
      move_uploaded_file($product_image4['tmp_name'], $imagePath4);
    }
    
    $stmt = $pdo->prepare('UPDATE products SET product_image1 =:product_image1,product_image2=:product_image2,product_image3=:product_image3,product_image4=:product_image4 WHERE product_id=:product_id');
        $stmt->bindValue(':product_image1',$imagePath);
        $stmt->bindValue(':product_image2',$imagePath2);
        $stmt->bindValue(':product_image3',$imagePath3);
        $stmt->bindValue(':product_image4',$imagePath4);
        
        $stmt->bindValue(':product_id',$product_id);

        if($stmt->execute()){
           $products = $stmt->fetch(PDO::FETCH_ASSOC);
           $_SESSION['message'] = "Images has been updated successfully";

            header('location:products.php?images_updated=Images has been updated successfully');
        }else{
            $_SESSION['message'] = " Error occured, try again";

            header('location:products.php?images_failed=Error occured, try again');
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