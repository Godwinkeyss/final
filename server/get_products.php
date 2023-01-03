<?php

include('connection.php');

$stmt =$pdo->prepare('SELECT * FROM products ORDER BY rand() LIMIT 5');

$stmt->execute();

$feature_products =$stmt->fetchAll(PDO::FETCH_ASSOC);
?>