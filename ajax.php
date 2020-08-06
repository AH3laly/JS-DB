<?php
/*
* Project: JS Database. 
* Description: Simple backend application for Javascript Projects.
* Author: Abdelrahman Helaly
* Contact: AH3laly@gmail.com
* Contact: https://Github.com/AH3laly
* License: Science not for Monopoly.
*/

namespace JSDB;
define("JSDB_ROOT", __DIR__);
require __DIR__.'/app/jsdb.php';
try {
    $JSDB = new API();
    $JSDB->initialize();
    if(Config::get("allow_basic_commands") && $JSDB->isBasicCommand()){
        // Will handle basic command
        $JSDB->handleRequest();
    } else if($commandName = $JSDB->getParam("command")){
        // Will handle custom command
        include JSDB_ROOT.'/app/custom.php';
        $actionName = "action_".$JSDB->getParam("command");
        if(function_exists($actionName)){
            $actionName();
        } else {
            throw new \Exception("Command not found");
        }
    }
    $JSDB->shutdown();
} catch(\Exception $e){
    $response = new Response();
    $response->setError(1)->setCode($e->getLine())->addMessage($e->getMessage(), "exception")->send();
}