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

class updateGetUser extends API {
    public function __construct(){
        parent::__construct();
    }
    public function execute(){
        
        // validate the Action
        $this->validate([
            "name"=>"required|min-length:10|max-length:50|is-character",
            "email"=>"required|email|max-length:255"
        ]);

        // Execute the Action
        $data = $this->schema->table("user")
            ->where("name", "==", $this->request->getParam("name"))
            ->update(["email"=>$this->request->getParam("email")])->select()->fetchAll();
        
        $this->response->addMessage("User Updated", "info")->setData($data)->send();
    }
}