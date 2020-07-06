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