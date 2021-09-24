<?php
namespace Ethos\Models;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DataContext{
    private $_serverName = "127.0.0.1";
    private $_userName = "thedigit";
    private $_password = "mY.q2VDz45k5@O";
    private $_connection;
    
    public function __construct(){
        
    }
    
    public function init(){
        try{
            $this->_connection = new \PDO("mysql:host=$this->_serverName;dbname=thedigit_Marijuana", $this->_userName, $this->_password);
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            echo "Connection failed: " . $e->getMessage();
        } 
        return $this->_connection;
    }
}

