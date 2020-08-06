<?php
/*
* Project: JS Database. 
* Description: Simple backend application for Javascript Projects.
* Author: Abdelrahman Helaly
* Contact: AH3laly@gmail.com
* Contact: https://Github.com/AH3laly
* License: Science not for Monopoly.
*/


/**
 * Add Custom Integration Here
 */

function example_sendError(){
    global $JSDB;
    $JSDB->response
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
function action_addUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")->insert([
        "name" => $JSDB->getParam("name"),
        "email" => $JSDB->getParam("email"),
        "password" => md5($JSDB->getParam("password"))
    ]);
    $JSDB->response->addMessage("User Added", "info")->setData(1)->send();
}

// Add and Get User
function action_addGetUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")->insert([
        "name" => $JSDB->getParam("name"),
        "email" => $JSDB->getParam("email"),
        "password" => md5($JSDB->getParam("password"))
    ])->select()->fetchAll();
    $JSDB->response->addMessage("User Added", "info")->setData($data)->send();
}

// Get User
function action_getUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")
    ->where("name", "==", $JSDB->getParam("name"))
    ->select()->fetchAll();
    $JSDB->response->addMessage("User Info", "info")->setData($data)->send();
}

// Get Users
function action_getUsers(){
    global $JSDB;
    $data = $JSDB->schema->table("user")->select()->fetchAll();
    $JSDB->response->addMessage("Users Info", "info")->setData($data)->send();
}

// Update User
function action_updateUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")
        ->where("name", "==", $JSDB->getParam("name"))
        ->update(["email"=>$JSDB->getParam("email")]);
    $JSDB->response->addMessage("User Updated", "info")->setData(1)->send();
}

// Update and Get User
function action_updateGetUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")
        ->where("name", "==", $JSDB->getParam("name"))
        ->update(["email"=>$JSDB->getParam("email")])->select()->fetchAll();
    $JSDB->response->addMessage("User Updated", "info")->setData($data)->send();
}

// Delete User
function action_deleteUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")
    ->where("name", "==", $JSDB->getParam("name"))
    ->delete();
    $JSDB->response->addMessage("User Deleted", "info")->setData(1)->send();
}

// Delete All Users
function action_deleteUsers(){
    global $JSDB;
    $data = $JSDB->schema->table("user")->delete();
    $JSDB->response->addMessage("Users Deleted", "info")->setData(1)->send();
}
