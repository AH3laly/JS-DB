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

        
    }
    
    // Add and Get User
    public function action_addGetUser(){

        
    }
    
    // Get User
    public function action_getUser(){

        
    }
    
    // Get Users
    public function action_getUsers(){
        
    }
    
    // Update User
    public function action_updateUser(){

        
    }
    
    // Update and Get User
    public function action_updateGetUser(){

        
    }
    
    // Delete User
    public function action_deleteUser(){

        
    }
    
    // Delete All Users
    public function action_deleteUsers(){
        
    }
    
}