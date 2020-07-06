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

class addGetUser extends API {
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
        ])->select()->fetchAll();

        $this->response->addMessage("User Added", "info")->setData($data)->send();
    }
}