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

class Defaults extends API {
    
    public function __construct(){
        parent::__construct();
    }

    public function example_sendError(){
        $this->response
            ->setError(1)
            ->setCode(565) // 565 is the error code
            ->addMessage("Exception message", "exception")
            ->addMessage("Error Message", "error")
            ->addMessage("Info Message", "info")
            ->addMessage("Warning Message", "info")
            ->setData("No Data")
            ->send();
    }
    
    // Add User
    public function action_addUser(){

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
    
    // Add and Get User
    public function action_addGetUser(){

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
    
    // Get User
    public function action_getUser(){

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
    
    // Get Users
    public function action_getUsers(){
        $data = $this->schema->table("user")->select()->fetchAll();
        $this->response->addMessage("Users Info", "info")->setData($data)->send();
    }
    
    // Update User
    public function action_updateUser(){

        // validate the Action
        $this->validate([
            "name"=>"required|min-length:10|max-length:50|is-character",
            "email"=>"required|email|max-length:255"
        ]);

        // Execute the Action
        $data = $this->schema->table("user")
            ->where("name", "==", $this->request->getParam("name"))
            ->update(["email"=>$this->request->getParam("email")]);
        $this->response->addMessage("User Updated", "info")->setData(1)->send();
    }
    
    // Update and Get User
    public function action_updateGetUser(){

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
    
    // Delete User
    public function action_deleteUser(){

        // validate the Action
        $this->validate([
            "name"=>"required|min-length:10|max-length:50|is-character"
        ]);

        // Execute the Action
        $data = $this->schema->table("user")
        ->where("name", "==", $this->request->getParam("name"))
        ->delete();
        $this->response->addMessage("User Deleted", "info")->setData(1)->send();
    }
    
    // Delete All Users
    public function action_deleteUsers(){
        $data = $this->schema->table("user")->delete();
        $this->response->addMessage("Users Deleted", "info")->setData(1)->send();
    }
    
}