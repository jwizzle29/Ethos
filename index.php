<?php
require_once('vendor/autoload.php');

$t = new \Ethos\Api\EthosApi();
$data = $t->getData();

foreach($data->data->filteredProducts->products as $product){
    echo $product->Name . "<br>";
}