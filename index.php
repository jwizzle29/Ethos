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
        $arrayOfUrls[$item->getCName()] = $strainData;      
        $products[$item->getCName()] = $item;
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
        $arrayOfUrls[$item->getCName()] = $strainData;
        $products[$item->getCName()] = $item;
    }
}

$strainInfo = processMultiCurls($arrayOfUrls);

foreach($products as $item){
    echo "NAME: " . $item->getName() . "<br>";
    echo $item->getStrainType() . "<br>";
    echo $item->getThcContent() . "<br>";
    echo $productUrl . $item->getCName() . "<br>";
    foreach($strainInfo[$item->getCName()]->data->filteredProducts->products as $sdata){
        //echo "Description : " .$sdata->description . "<br>";  
        $stripped = preg_replace("/[^a-zA-Z0-9\s\p{P}]/", "", $sdata->description);
        $item->setDescription(strip_tags($stripped));
        //echo "TERP DATA: <br><pre>";
        //print_r($sdata->terpenes);exit;
        foreach($sdata->terpenes as $terpData){
            $value = "";
            if($terpData->value == ""){
                $value = null;
            }else{
                $value = $terpData->value;
            }
            $terpName = str_replace(" ", "", $terpData->libraryTerpene->name);
            $methodName = "set{$terpName}";
            echo $methodName . "({$value})<br>";
            $item->$methodName($value);
            //echo $terpData->libraryTerpene->name . "<br>";
            //echo $terpData->value . "<br>";
        }
    }
    
    $desription = $item->getDescription();
    
    
    
    /*$item->setPinene(
            findStr("Pinene-", "%", $desription)
    );
    $item->setBetaPinene(
            findStr("B Pinene--", "%", $desription)
    );
    $item->setBetaMyrcene(
            findStr("B Myrcene-", "%", $desription)
    );
    $item->setBetaCaryophyllene(
            findStr("B Caryophyllene-", "%", $desription)
    );
    $item->setBisabolol(
            findStr("Bisabolol-", "%", $desription)
    );
    $item->setCaryophylleneOxide(
            findStr("CaryophylleneOxide-", "%", $desription)
    );
    $item->setHumulene(
            findStr("Humulene-", "%", $desription)
    );
    $item->setLimonene(
            findStr("Limonene-", "%", $desription)
    );
    $item->setLinalool(
            findStr("Linalool-", "%", $desription)
    );
    $item->setTerpinolene(
            findStr("Terpinolene-", "%", $desription)
    );*/
    
    $priceArray = [
      '1g' => "",
      '1/8oz' => "",
      '1/4oz' => ""
    ];
    
    foreach($sdata->Options as $opt){
        foreach($sdata->Prices as $price){
            $priceArray[$opt] = $price;
        }
    }
    
    $item->setGramPrice($priceArray['1g']);
    $item->setGramPrice($priceArray['1/8oz']);
    $item->setGramPrice($priceArray['1/4oz']);
    
    $lineageStr = getBetween($desription, "Lineage:", "Batch");
    //$e = explode($lineageStr, "x");
    
    //for($i = 1; $i <= count($e);$i++){
    //    $methodName = "setLineage$i";
    //    $item->$methodName($e[$i]);
    //}
    $item->setLineage(
            $lineageStr
    );
    /*echo "Pinene : " . findStr("Pinene-", "%", $desription) . "<br>";
    echo "BetaPinene : " . findStr("B Pinene-", "%", $desription) . "<br>";
    echo "BetaMyrcene : " . findStr("B Myrcene-", "%", $desription) . "<br>";
    echo "BetaCaryophyllene : " . findStr("B Caryophyllene-", "%", $desription) . "<br>";
    echo "Bisabolol : " . findStr("Bisabolol-", "%", $desription) . "<br>";
    echo "CaryophylleneOxide : " . findStr("CaryophylleneOxide-", "%", $desription) . "<br>";
    echo "Humulene : " . findStr("Humulene-", "%", $desription) . "<br>";
    echo "Limonene : " . findStr("Limonene-", "%", $desription) . "<br>";
    echo "Linalool : " . findStr("Linalool-", "%", $desription) . "<br>";
    echo "Terpinolene : " . findStr("Terpinolene-", "%", $desription) . "<br>";
    echo "Lineage : " . getBetween($desription, "Lineage:", "Batch") . "<br>";
    echo "Lineage1 : " . $item->getLineage1() . "<br>";
    echo "Lineage2 : " . $item->getLineage2() . "<br>";
    echo "Lineage3 : " . $item->getLineage3() . "<br>";
    echo "Lineage4 : " . $item->getLineage4() . "<br>";*/
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
