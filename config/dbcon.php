<?php
  // $host = "localhost";
  // $username = "root";
  // $password = "";
  // $database = "slaybeast";

  // $con = mysqli_connect($host,$username,$password,$database);

  // if(!$con){
  //   die('Connection failed'. mysqli_connect_error());
  // }

  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=slaybeast', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  

?>