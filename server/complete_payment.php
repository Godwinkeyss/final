<?php
session_start();
include('connection.php');

$ref =$_GET['reference'];
if($refv= ""){
    // header("location:javascript://history.go(-1)");
}
?>


<?php  


if(isset($_GET['reference']) && isset($_GET['order_id'])){
            // change order_status to paid

            $order_id = $_GET['order_id'];
            $order_status = "paid";
            $reference = $_GET['reference'];
            $user_id = $_SESSION['user_id'];
            $payment_date = date('Y-m-d H:i:s');



            $stmt = $pdo->prepare('UPDATE orders SET order_status = :order_status WHERE order_id = :order_id');
                $stmt->bindValue(':order_status',$order_status);
                $stmt->bindValue(':order_id',$order_id);
               $stmt->execute();



                // store payment info in database

         $stmt1 = $pdo->prepare("INSERT INTO payments(order_id,user_id,transaction_id,payment_date) VALUES(:order_id,:user_id,:transaction_id,:payment_date );");
         $stmt1->bindValue(':order_id',$order_id);
         $stmt1->bindValue(':user_id',$user_id);
         $stmt1->bindValue(':transaction_id',$reference);
         $stmt1->bindValue(':payment_date',$payment_date);
         $stmt1->execute();
         



            // go to user account
            header('location: ../account.php?payment_message=paid successfully, thanks for shopping with us');
}else{
    header('location: ../index.php');
    exit;
}



?>


<?php
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer sk_test_d9749f6c87801c71e626edfadd3727447447abbf",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    // echo $response;
    $result = json_decode($response);
  }
//   if($result->data->status == 'paid'){
//     $status = $result->data->status;
//     $reference = $result->data->reference;
//     $lname =  $result->data->customer->last_name;
//     $fname =  $result->data->customer->first_name;
//     $fullname = $lname.' '.$fname;
//     $Cus_email = $result->data->customer->email;
//     date_default_timezone_set('Africa/Lagos');
//     $Date_time = date('m/d/Y h:i:s', time());

//     include('server/connection.php');
//     $stmt =  $pdo->prepare("INSERT INTO customer_details (status,reference,fullname, date_purchase,email) VALUES(:status,:reference:fullname,:date_purchase,:email)");

//     $stmt->bindValue(':status',$status);
//     $stmt->bindValue(':reference',$reference);
//     $stmt->bindValue(':fullname',$fullname);
//     $stmt->bindValue(':date_purchase',$Date_time);
//     $stmt->bindValue(':email',$Cus_email);
//     $stmt->execute();
//     if(!$stmt){
//         echo 'There was a problem on your code'. $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     }else{
//         header('location: success.php?status=success');
//         exit;
//     }
    



//   }else{
//     header('location: error.html');
//     exit;
//   }
?>