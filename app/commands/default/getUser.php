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

class getUser extends API {
    public function __construct(){
        parent::__construct();
    }
    public function execute(){
        
        // validate the Action
        $this->validate([
            "name"=>"required|min-length:10|max-length:50|is-character"
        ]);

        // Execute the Action
        $data = $this->schema->table("user")
        ->where("name", "==", $this->request->getParam("name"))
        ->select()->fetchAll();
        
        $this->response->addMessage("User Info", "info")->setData($data)->send();

    }
}