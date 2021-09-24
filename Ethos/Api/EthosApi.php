<?php
namespace Ethos\Api;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EthosApi{
    
    public function __construct(){
        
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
    
    public function getData(){
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
            "page" => 0,
            "perPage" => 50
        ];

        $extensions = [
            "persistedQuery" => [
                "version" => 1,
                "sha256Hash" => "2d89541bc0b8331b81d28ada47bb8a0a0c633c1f704832dc0c7e537934216606"
            ]
        ];

        $url = 'https://allentown.ethoscannabis.com/graphql?operationName=FilteredProducts&variables=' . json_encode($options) . '&extensions=' . json_encode($extensions);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        $data = json_decode($output);
        curl_close($ch);
        
        return $this->EthosCurl($url);
    }
}

