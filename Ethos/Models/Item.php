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
    private $_terpines;
    private $_type;
    private $_thcContent;
    private $_prices = [
        '1g' => "",
        '1/8' => "",
        '1/4' => ""
    ];
    
    public function __construct(){
        
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
}
