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

class getUsers extends API {
    public function __construct(){
        parent::__construct();
    }
    public function execute(){
        
        $data = $this->schema->table("user")->select()->fetchAll();
        
        $this->response->addMessage("Users Info", "info")->setData($data)->send();
    }
}