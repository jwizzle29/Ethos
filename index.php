<?php
require_once('vendor/autoload.php');

$t = new \Ethos\Api\EthosApi();
$initialPage = $t->getData();

$pages = $initialPage->data->filteredProducts->queryInfo->totalPages;
$items = $initialPage->data->filteredProducts->queryInfo->totalCount;
$count = 0;
echo "Item count " . $items . "<br>";
foreach($initialPage->data->filteredProducts->products as $product){
        array_push($products, $product->Name);
}
echo "num pages " . $pages;
$products = [];
foreach($initialPage->data->filteredProducts->products as $product){
        array_push($products, $product->Name);
}
for($i = 1; $i <= $pages; $i++){
    echo "reading Page " . $i . "<br>";
    $data = $t->getData($i);
    foreach($data->data->filteredProducts->products as $product){
        array_push($products, $product->Name);
    }
}

print_r($products);

$servername = "127.0.0.1";
$username = "thedigit";
$password = "mY.q2VDz45k5@O";

try {
  $conn = new PDO("mysql:host=$servername;dbname=thedigit_Marijuana", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
