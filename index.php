<?php
require_once('vendor/autoload.php');
$productUrl = "https://allentown.ethoscannabis.com/stores/mission-allentown/product/";
$t = new \Ethos\Api\EthosApi();
$initialPage = $t->getData();

//$dataContext = new \Ethos\Models\DataContext();
//$db = $dataContext->init();
$_serverName = "127.0.0.1";
$_userName = "thedigit";
$_password = "mY.q2VDz45k5@O";
$db = new \PDO("mysql:host=$_serverName;dbname=thedigit_Marijuana", $_userName, $_password);
$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);



$pages = $initialPage->data->filteredProducts->queryInfo->totalPages;
$items = $initialPage->data->filteredProducts->queryInfo->totalCount;
$count = 0;
$products = [];
$arrayOfUrls = [];
foreach($initialPage->data->filteredProducts->products as $product){
        $item = new \Ethos\Models\Item($db);
        $item->setName($product->Name);
        $item->setThcContent($product->THCContent->range[0]);
        $item->setStrainType($product->strainType);
        $item->setCName($product->cName);
        $strainData = $t->getStrainData($item->getCName());
        //echo "STRAIN DATA: " . $strainData . "<br>";
        //array_push($arrayOfUrls[$product->Name], $strainData);
        $arrayOfUrls[$item->getCName()] = $strainData;
        /*foreach($strainData->data->filteredProducts->products as $sdata){
            $item->setDescription($sdata->description);
        }
        if (preg_match('/Lineage:-(.*?)-Batch/', $sdata->description, $match) == 1) {
            $item->setLineage($match[1]);
        }*/
        
        $products[$item->getCName()] = $item;
        //array_push($products, $item);
}
for($i = 1; $i <= $pages; $i++){
    $data = $t->getData($i);
    foreach($data->data->filteredProducts->products as $product){
        $item = new \Ethos\Models\Item($db);
        $item->setName($product->Name);
        $item->setThcContent($product->THCContent->range[0]);
        $item->setStrainType($product->strainType);
        $item->setCName($product->cName);
        $strainData = $t->getStrainData($item->getCName());
        //echo "key: " .$item->getCName() . " >> STRAIN DATA: " . $strainData . "<br>";
        $arrayOfUrls[$item->getCName()] = $strainData;
        //print_r($multiCurlArray);exit;
        /*foreach($strainData->data->filteredProducts->products as $sdata){
            $item->setDescription($sdata->description);
        }
        if (preg_match('/Lineage:-(.*?)-Batch/', $sdata->description, $match) == 1) {
            $item->setLineage($match[1]);
        }*/
        //array_push($products, $item);
        $products[$item->getCName()] = $item;
    }
}



//foreach($arrayOfUrls as $idx => $value){
 //   echo $value . "<br>";
//}
$strainInfo = processMultiCurls($arrayOfUrls);
//print_r($strainInfo);
//foreach($strainInfo as $i => $value){
//    $products[$i->]
//}


foreach($products as $item){
    echo $item->getName() . "<br>";
    echo $item->getStrainType() . "<br>";
    echo $item->getThcContent() . "<br>";
    echo $productUrl . $item->getCName() . "<br>";
    foreach($strainInfo[$item->getCName()]->data->filteredProducts->products as $sdata){
        echo "Description : " .$sdata->description . "<br>";      
    }
    $stripped = preg_replace("/[^a-zA-Z0-9\s\p{P}]/", "", $sdata->description); 
    $item->setDescription(strip_tags($stripped));
    $item->setPinene(
            findStr("Pinene-", "%", $sdata->description)
    );
    $item->setBetaPinene(
            findStr("B Pinene--", "%", $sdata->description)
    );
    $item->setBetaMyrcene(
            findStr("B Myrcene-", "%", $sdata->description)
    );
    $item->setBetaCaryophyllene(
            findStr("B Caryophyllene-", "%", $sdata->description)
    );
    $item->setBisabolol(
            findStr("Bisabolol-", "%", $sdata->description)
    );
    $item->setCaryophylleneOxide(
            findStr("CaryophylleneOxide-", "%", $sdata->description)
    );
    $item->setHumulene(
            findStr("Humulene-", "%", $sdata->description)
    );
    $item->setLimonene(
            findStr("Limonene-", "%", $sdata->description)
    );
    $item->setLinalool(
            findStr("Linalool-", "%", $sdata->description)
    );
    $item->setTerpinolene(
            findStr("Terpinolene-", "%", $sdata->description)
    );
    
    $item->setLineage(
            getBetween( $sdata->description, "Lineage:", "Batch")
    );
    echo "Pinene : " . findStr("Pinene-", "%", $sdata->description) . "<br>";
    echo "BetaPinene : " . findStr("B Pinene-", "%", $sdata->description) . "<br>";
    echo "BetaMyrcene : " . findStr("B Myrcene-", "%", $sdata->description) . "<br>";
    echo "BetaCaryophyllene : " . findStr("B Caryophyllene-", "%", $sdata->description) . "<br>";
    echo "Bisabolol : " . findStr("Bisabolol-", "%", $sdata->description) . "<br>";
    echo "CaryophylleneOxide : " . findStr("CaryophylleneOxide-", "%", $sdata->description) . "<br>";
    echo "Humulene : " . findStr("Humulene-", "%", $sdata->description) . "<br>";
    echo "Limonene : " . findStr("Limonene-", "%", $sdata->description) . "<br>";
    echo "Linalool : " . findStr("Linalool-", "%", $sdata->description) . "<br>";
    echo "Terpinolene : " . findStr("Terpinolene-", "%", $sdata->description) . "<br>";
    echo "Lineage : " . getBetween( $sdata->description, "Lineage:", "Batch") . "<br>";
    try{
        $item->save();
    } catch (Exception $ex) {
        echo "EXCEPTION: " . $ex->getMessage();
    }
    
}

function findStr($start,$end, $string){
    if (preg_match("/{$start}(.*?){$end}/", $string, $match) == 1) {
        return $match[1];
    }
    return null;
}

function getBetween($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
  }



function processMultiCurls($multicurlarray){
    $mh = curl_multi_init();
    $kk = [];
    
    foreach($multicurlarray as $idx => $value){
        $kk[$idx] = curl_init();
        curl_setopt($kk[$idx], CURLOPT_URL, $value);
        curl_setopt($kk[$idx], CURLOPT_RETURNTRANSFER, 1);
        curl_multi_add_handle($mh,$kk[$idx]);
    }
    $running = null;
    do {
      curl_multi_exec($mh, $running);
    } while ($running);
    
    $responses = [];
    
    foreach($multicurlarray as $idx => $value){
        curl_multi_remove_handle($mh, $kk[$idx]);
    }
    
    foreach($multicurlarray as $idx => $value){
        $responses[$idx] = json_decode(curl_multi_getcontent($kk[$idx]));
    }
    curl_multi_close($mh);
    return $responses;
}
