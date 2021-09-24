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
    private $_type;
    private $_thcContent;
    private $_prices = [
        '1g' => "",
        '1/8' => "",
        '1/4' => ""
    ];
    
    public function __construct(){
        $this->_dataContext = new DataContext();
        $this->_dataContext->init();
        
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
        
            $this->_dataContext->_connection->prepare($saveQuery);
            $this->_dataContext->bindParam(":Name", $this->getName());
            $this->_dataContext->bindParam(":BetaCaryophyllene", $this->getBetaCaryophyllene());
            $this->_dataContext->bindParam(":BetaMyrcene", $this->getBetaMyrcene());
            $this->_dataContext->bindParam(":BetaPinene", $this->getBetaPinene());
            $this->_dataContext->bindParam(":Bisabolol", $this->getBisabolol);
            $this->_dataContext->bindParam(":CaryophylleneOxide", $this->getCaryophylleneOxide);
            $this->_dataContext->bindParam(":Humulene", $this->getHumulene());
            $this->_dataContext->bindParam(":Limonene", $this->getLimonene());
            $this->_dataContext->bindParam(":Linalool", $this->getLinalool());
            $this->_dataContext->bindParam(":Terpinolene", $this->getTerpinolene());
            $this->_dataContext->bindParam(":Pinene", $this->getPinene());
            $this->_dataContext->bindParam(":cName", $this->getCName());
            $this->_dataContext->bindParam(":Description", $this->getDescription());
            $this->_dataContext->bindParam(":EightPrice", $this->getEigthPrice);
            $this->_dataContext->bindParam(":QuarterPrice", $this->getQuarterPrice());
            $this->_dataContext->bindParam(":GramPrice", $this->getGramPrice());
            $this->_dataContext->bindParam(":Lineage", $this->getLineage());
            $this->_dataContext->bindParam(":ThcContent", $this->getThcContent());
            $this->_dataContext->bindParam(":StrainType", $this->getStrainType());

            $this->_dataContext->_connection->execute();
        } catch (Exception $e) {
            echo "Exception : " . $e->getMessage();
        }
        
    }
}
