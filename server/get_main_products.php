<?php

include('connection.php');

$stmt =$pdo->prepare('SELECT * FROM products  LIMIT 7');

$stmt->execute();

$main_products =$stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $pdo->prepare('SELECT * FROM countries');
$stmt->execute();
$country =$stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT * FROM states');
$stmt->execute();
$states =$stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $pdo->prepare('SELECT * FROM wallpapers');
$stmt2->execute();
$walls =$stmt2->fetchAll(PDO::FETCH_ASSOC);

?>