<?php
/*
* Project: JS Database. 
* Description: Simple backend application for Javascript Projects.
* Author: Abdelrahman Helaly
* Contact: AH3laly@gmail.com
* Contact: https://github.com/AHelaly
* License: Science not for Monopoly.
*/

namespace JSDB;

class Login extends API {
    public function __construct(){
        parent::__construct();
    }
    public function execute(){
        $validate = $this->validate([
            //"username,password" => "required|min-length:8|max-length:12",
            "username" => "lower:1000",
            "password" => "has-number|has-character",
        ]);
        //print_r($validate);
    }
}