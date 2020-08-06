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

class addUser extends API {
    public function __construct(){
        parent::__construct();
    }
    public function execute(){
        
        // validate the Action
        $this->validate([
            "name"=>"required|min-length:10|max-length:50|is-character",
            "email"=>"required|email|max-length:255",
            "password" => "required|has-number|has-character|min-length:8|max-length:50"
        ]);

        // Execute the Action
        $data = $this->schema->table("user")->insert([
            "name" => $this->request->getParam("name"),
            "email" => $this->request->getParam("email"),
            "password" => md5($this->request->getParam("password"))
        ]);

        $this->response->addMessage("User Added", "info")->setData(1)->send();
    }
}