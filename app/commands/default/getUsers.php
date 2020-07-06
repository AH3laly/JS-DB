<?php
/*
* Project: JS Database. 
* Description: Simple backend application for Javascript Projects.
* Author: Abdelrahman Mohamed
* Contact: Abdo.Tasks@Gmail.Com
* Contact: https://Github.com/abd0m0hamed
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