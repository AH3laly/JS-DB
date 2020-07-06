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
define("JSDB_ROOT", __DIR__);
require __DIR__.'/app/jsdb.php';

class AJAX {
    private $handler = null;
    public function __construct(){
        $this->request = new Request();
    }
    private function isBasicCommand(){
        $basicCommands = ["select", "insert", "update", "delete"];
        return in_array($this->request->getParam("command"), $basicCommands);
    }
    public function initialize(){
        try {
            if(Config::get("allow_basic_commands") && $this->isBasicCommand()){
                // Will handle basic command
                $handler = new API();
                $handler->initialize();
                $handler->handleRequest();
                $handler->shutdown();
            } else if($commandName = $this->request->getParam("command")){
                
                $commandInfo = $this->extractCommand($commandName);
                if($commandInfo["controller"] == ""){
                    // Load default controller
                    $controllerToLoad = JSDB_ROOT.'/app/custom.php';
                } else {
                    // Load requested controller
                    $controllerToLoad = JSDB_ROOT.'/app/custom/'.strtolower($commandInfo["controller"]).'.php';
                }
                if(!file_exists($controllerToLoad)){
                    throw new \Exception("Invalid Controller");
                } else {
                    require_once $controllerToLoad;
                }
                if(!class_exists('JSDB\\'.$commandInfo["class"])){
                    throw new \Exception("Invalid Class");
                }
                $classToLoad = "JSDB\\{$commandInfo['class']}";
                $handler = new $classToLoad();
                if(!method_exists($handler, $commandInfo["method"])){
                    throw new \Exception("Command not found");
                }
                $handler->initialize();
                $handler->{$commandInfo["method"]}();
                $handler->shutdown();
            }
        } catch(JSDBException $e){
            $response = new Response();
            $response->setError(1)->setCode($e->getLine())->addMessage($e->getMessage(), "exception")->setData($e->getData())->send();
        }
    }
    private function extractCommand($commandName){
        
        // Validate command
        if(!preg_match("/^[a-z0-9]+([a-z0-9]+\.)*[a-z0-9]+$/i", $commandName)){
            throw new \Exception("Bad Command");
        }
        $commandParts = explode(".", $commandName);
        if(count($commandParts) === 1){
            $commandInfo = [
                "method" => "execute",
                "class" => $commandName,
                "controller" => "default/".$commandName
            ];
        } else if(count($commandParts) >= 2){
            $commandInfo = [
                "method" => "execute",
                "class" => $commandParts[count($commandParts)-1],
                "controller" => implode("/", $commandParts)
            ];
        } else {
            throw new \Exception("Invalid command Parts");
        }

        $commandInfo["class"] = ucfirst(strtolower($commandInfo["class"]));

        return $commandInfo;
    }
}

$AJAX = new AJAX();
$AJAX->initialize();