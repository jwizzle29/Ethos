<?php
namespace Ethos\Api;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EthosApi{
    
    private $_pages;
    private $_items;
    
    public function __construct(){
        
    }
    
    public function setPages($pages){
        $this->_pages = $pages;
    }
    
    public function getPages(){
        return $this->_pages;
    }
    
    public function setItems($items){
        $this->_items = $items;
    }
    
    public function getItems(){
        return $this->_items;
    }
    
    public function EthosCurl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        $data = json_decode($output);
        curl_close($ch);
        
        return $data;
    }
    
    public function getData($page = 0){
        $options = [
            "includeCannabinoids" => false,
            "showAllSpecialProducts" => false,
            "productsFilter" => [
                "dispensaryId" => "4bZmK4MfjoypZ8MdN",
                "pricingType"=>"med",
                "strainTypes"=>[],
                "subcategories"=>[],
                "Status"=>"Active",
                "removeProductsBelowOptionThresholds"=>true,
                "types"=>["Flower"],
                "useCache"=>false,
                "sortDirection"=>1,
                "sortBy"=>"weight",
                "bypassOnlineThresholds"=>false,
                "isKioskMenu"=>false
            ],
            "page" => $page,
            "perPage" => 50
        ];

        $extensions = [
            "persistedQuery" => [
                "version" => 1,
                "sha256Hash" => "2d89541bc0b8331b81d28ada47bb8a0a0c633c1f704832dc0c7e537934216606"
            ]
        ];

        $url = 'https://allentown.ethoscannabis.com/graphql?operationName=FilteredProducts&variables=' . json_encode($options) . '&extensions=' . json_encode($extensions);

        /*$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        $data = json_decode($output);
        curl_close($ch);*/
        
        return $this->EthosCurl($url);
    }
    
    public function getStrainData($cname){
        /*
         {
          "includeTerpenes":true,
          "includeCannabinoids":true,
         * "productsFilter":
         *      {
         *          "cName":"natural-selections-mint-mango-manchego-unchained-pheno-3-5g",
         *          "dispensaryId":"4bZmK4MfjoypZ8MdN",
         *          "removeProductsBelowOptionThresholds":true,
         *          "isKioskMenu":false,
         *          "bypassKioskThresholds":false,
         *          "bypassOnlineThresholds":true
         *      }
         }
         * &extensions=
         * {"persistedQuery":
         *      {
         *          "version":1,
         *          "sha256Hash":"9bfe5c55e7c45016732619d6dc6e378a02fd50caa18a6b2f02f2dd07adb034ec"
         *      }
         * }
         */
        
        $options = [
            "includeTerpenes" => true,
            "includeCannabinoids" => false,
            "showAllSpecialProducts" => false,
            "productsFilter" => [
                "cName"=>$cname,
                "dispensaryId"=>"4bZmK4MfjoypZ8MdN",
                "removeProductsBelowOptionThresholds"=>true,
                "isKioskMenu"=>false,
                "bypassKioskThresholds"=>false,
                "bypassOnlineThresholds"=>true
            ],
        ];

        $extensions = [
            "persistedQuery" => [
                "version" => 1,
                "sha256Hash" => "9bfe5c55e7c45016732619d6dc6e378a02fd50caa18a6b2f02f2dd07adb034ec"
            ]
        ];
        $url = 'https://allentown.ethoscannabis.com/graphql?operationName=FilteredProducts&variables=' . json_encode($options) . '&extensions=' . json_encode($extensions);
        return $url;//$this->EthosCurl($url);
    }
}

