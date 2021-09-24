<?php
namespace Ethos\Models;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Item{
    private $_name;
    private $_lineage;
    private $_strainType;
    private $_cName;
    private $_description;
    private $_lineage1;
    private $_lineage2;
    private $_lineage3;
    private $_lineage4;
    private $_lineage5;
    
    private $_terpines = [
        'beta-caryophyllene' => "",
        'limonene' => "",
        'humulene' => "",
        'linalool' => "",
        'beta-myrcene' => "",
        'beta-pinene' => "",
        'caryophyllene-oxide' => "",
        'pinene' => "",
        'bisabolol' => "",
        'terpinolene' => ""
    ];
    private $_dataContext;
    public $Connection;
    private $_type;
    private $_thcContent;
    private $_prices = [
        '1g' => "",
        '1/8' => "",
        '1/4' => ""
    ];
    
    public function __construct(){
        $this->_dataContext = new DataContext();
        $this->Connection = $this->_dataContext->init();
    }
    
    public function getConnection(){
        return $this->Connection;
    }
    
    public function setName($name){
        $this->_name = $name;
    }
    
    public function getName(){
        return $this->_name;
    }
    
    public function setLineage($lineage){
        $this->_lineage = $lineage;
    }
    
    public function getLineage(){
        return $this->_lineage;
    }
    
    public function setTerpines($terpines){
        $this->_terpines = $terpines;
    }
    
    public function getTerpines(){
        return $this->_terpines;
    }
    
    public function setType($type){
        $this->_type = $type;
    }
    
    public function getType(){
        return $this->_type;
    }
    
    public function setThcContent($thc){
        $this->_thcContent = $thc;
    }
    
    public function getThcContent(){
        return $this->_thcContent;
    }
    
    public function setGramPrice($price){
        $this->_prices['1g'] = $price;
    }
    
    public function getGramPrice(){
        return $this->_prices['1g'];
    }
    
    public function setEigthPrice($price){
        $this->_prices['1/8'] = $price;
    }
    
    public function getEigthPrice(){
        return $this->_prices['1/8'];
    }
    
    public function setQuarterPrice($price){
        $this->_prices['1/4'] = $price;
    }
    
    public function getQuarterPrice(){
        return $this->_prices['1/4'];
    }
    
    public function setBetaCaryophyllene($terp){
        $this->_terpines['beta-caryophyllene'] = $terp;
    }
    
    public function getBetaCaryophyllene(){
        return $this->_terpines['beta-caryophyllene'];
    }
    
    public function setLimonene($terp){
        $this->_terpines['limonene'] = $terp;
    }
    
    public function getLimonene(){
        return $this->_terpines['limonene'];
    }
    
    public function setLinalool($terp){
        $this->_terpines['linalool'] = $terp;
    }
    
    public function getLinalool(){
        return $this->_terpines['linalool'];
    }
    
    public function setBetaPinene($terp){
        $this->_terpines['beta-pinene'] = $terp;
    }
    
    public function getBetaPinene(){
        return $this->_terpines['beta-pinene'];
    }
    
    public function setBetaMyrcene($terp){
        $this->_terpines['beta-myrcene'] = $terp;
    }
    
    public function getBetaMyrcene(){
        return $this->_terpines['beta-myrcene'];
    }
    
    public function setHumulene($terp){
        $this->_terpines['humulene'] = $terp;
    }
    
    public function getHumulene(){
        return $this->_terpines['humulene'];
    }
    
    public function setPinene($terp){
        $this->_terpines['pinene'] = $terp;
    }
    
    public function getPinene(){
        return $this->_terpines['pinene'];
    }
    
    public function setBisabolol($terp){
        $this->_terpines['bisabolol'] = $terp;
    }
    
    public function getBisabolol(){
        return $this->_terpines['bisabolol'];
    }
    
    public function setCaryophylleneOxide($terp){
        $this->_terpines['caryophyllene-oxide'] = $terp;
    }
    
    public function getCaryophylleneOxide(){
        return $this->_terpines['caryophyllene-oxide'];
    }
    
    public function setTerpinolene($terp){
        $this->_terpines['terpinolene'] = $terp;
    }
    
    public function getTerpinolene(){
        return $this->_terpines['terpinolene'];
    }
    
    public function setStrainType($type){
        $this->_strainType = $type;
    }
    
    public function getStrainType(){
        return $this->_strainType;
    }
    
    public function setCName($cname){
        $this->_cName = $cname;
    }
    
    public function getCName(){
        return $this->_cName;
    }
    
    public function setDescription($description){
        $this->_description = $description;
    }
    
    public function getDescription(){
        return $this->_description;
    }
    
    public function setLineage1($lineage){
        $this->_lineage1 = $lineage;
    }
    
    public function getLineage1(){
        return $this->_lineage1;
    }
    
    public function setLineage2($lineage){
        $this->_lineage2 = $lineage;
    }
    
    public function getLineage2(){
        return $this->_lineage2;
    }
    
    public function setLineage3($lineage){
        $this->_lineage3 = $lineage;
    }
    
    public function getLineage3(){
        return $this->_lineage3;
    }
    
    public function setLineage4($lineage){
        $this->_lineage4 = $lineage;
    }
    
    public function getLineage4(){
        return $this->_lineage4;
    }
    
    public function save(){
        try{
            $saveQuery = "INSERT INTO Items "
                . "SET BetaCaryophyllene=:BetaCaryophyllene,"
                . "SET BetaMyrcene=:BetaMyrcene, "
                . "SET BetaPinene=:BetaPinene, "
                . "SET Bisabolol=:Bisabolol, "
                . "SET CaryophylleneOxide=:CaryophylleneOxide, "
                . "SET Humulene=:Humulene, "
                . "SET Limonene=:Limonene, "
                . "SET Linalool=:Linalool, "
                . "SET Pinene=:Pinene, "
                . "SET Terpinolene=:Terpinolene, "
                . "SET cName=:cName, "
                . "SET Description=:Description, "
                . "SET EightPrice=:EighthPrice, "
                . "SET QuarterPrice=:QuarterPrice, "
                . "SET GramPrice=:GramPrice, "
                . "SET Name=:Name, "
                . "SET Lineage=:Lineage, "
                . "SET ThcContent=:ThcContent, "
                . "SET StrainType=:StrainType, ";
        
            $this->Connection->prepare($saveQuery);
            $this->Connection->bindParam(":Name", $this->getName());
            $this->Connection->bindParam(":BetaCaryophyllene", $this->getBetaCaryophyllene());
            $this->Connection->bindParam(":BetaMyrcene", $this->getBetaMyrcene());
            $this->Connection->bindParam(":BetaPinene", $this->getBetaPinene());
            $this->Connection->bindParam(":Bisabolol", $this->getBisabolol);
            $this->Connection->bindParam(":CaryophylleneOxide", $this->getCaryophylleneOxide);
            $this->Connection->bindParam(":Humulene", $this->getHumulene());
            $this->Connection->bindParam(":Limonene", $this->getLimonene());
            $this->Connection->bindParam(":Linalool", $this->getLinalool());
            $this->Connection->bindParam(":Terpinolene", $this->getTerpinolene());
            $this->Connection->bindParam(":Pinene", $this->getPinene());
            $this->Connection->bindParam(":cName", $this->getCName());
            $this->Connection->bindParam(":Description", $this->getDescription());
            $this->Connection->bindParam(":EightPrice", $this->getEigthPrice);
            $this->Connection->bindParam(":QuarterPrice", $this->getQuarterPrice());
            $this->Connection->bindParam(":GramPrice", $this->getGramPrice());
            $this->Connection->bindParam(":Lineage", $this->getLineage());
            $this->Connection->bindParam(":ThcContent", $this->getThcContent());
            $this->Connection->bindParam(":StrainType", $this->getStrainType());

            $this->Connection->_connection->execute();
        } catch (Exception $e) {
            echo "Exception : " . $e->getMessage();
        }
        $this->Connection = null;
    }
}
