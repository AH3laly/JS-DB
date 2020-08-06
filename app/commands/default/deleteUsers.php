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

class deleteUsers extends API {
    public function __construct(){
        parent::__construct();
    }
    public function execute(){
        
        $data = $this->schema->table("user")->delete();
        
        $this->response->addMessage("Users Deleted", "info")->setData(1)->send();
    }
}