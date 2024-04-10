<?php
include('connection.php');

$st =$conn->prepare("SELECT*FROM products LIMIT 4");
$st->execute();

$featured_products = $st->get_result();



?>