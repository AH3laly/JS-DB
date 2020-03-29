# Welcome to JS-DB

Many JavaScript projects requires server side Project to retain data,

This is a simple Cloud-Based database solution to handle backend side without having to build complete backend application.

# Getting Started

## Requirements:
- Linux Server running Apache / PHP
- SSD HardDisk is recommended

## Installation on Production:

```sh
cd /var/www/html
git pull https://github.com/Abd0M0hamed/JS-DB.git ./jsdb
# Change apache_daemon_user to the user used by Apache server to execute PHP scripts
apache_daemon_user=apache
chown $apache_daemon_user:$apache_daemon_user jsdb -R
chmod 700 jsdb/var/data -R
chmod 700 jsdb/var/log -R
```

## Configuration on Production:

Open **app/jsdb.php** file

```php
private static $configuration = [

    // Allows to display all errors and warnings (used for debugging)
    "debug_mode" => 0,

    // Instructs the application to use demo database for testing ("test.jsdb")
    "testing_mode" => 0,
    
    // Enable or disable Logging
    "logging" => 0,
    
    // Basic commands are (select, insert, update, delete)
    // If basic commands are disabled, then only custom actions defined in custom.php will be allowed
    "allow_basic_commands" => 1,
    
    // Tables in db_write_protected_tables are not readable anyway
    "db_read_protected_tables" => ["__jsdb_core"],

    // Tables in db_write_protected_tables are not writable anyway
    "db_write_protected_tables" => ["__jsdb_core"],

    // Domains allowed to hit the API (Referers)
    "allowed_domains" => []
];
```

# *IMPORTANT:*

**testing_mode** and **debug_mode** must be set to **0** on production.

**allowed_domains** array must include all domains that allowed to Send AJAX requests to the JSDB,

***Note:** domain.com doesn't include www.domain.com, any.domain.com, you have to add each subdomain separately*

**allow_basic_commands** should be set to **0** if you plan to define your custom actions in **app/custom.php**

## Setup Docker environment for Testing and Development

#### Execute the following on bash:

```sh
mkdir /opt/jsdb/dev -p
git clone https://github.com/Abd0M0hamed/JS-DB.git /opt/jsdb/dev
chmod 777 /opt/jsdb/dev/var/data /opt/jsdb/dev/var/log
touch /opt/jsdb/Dockerfile
```

#### Add the following Docker image code in **/opt/jsdb/Dockerfile**:

```sh
FROM centos
RUN rpm --import http://download.fedoraproject.org/pub/epel/RPM-GPG-KEY-EPEL-7
RUN rpm --import https://rpms.remirepo.net/RPM-GPG-KEY-remi
RUN yum install -y php php-json httpd
RUN mkdir /run/php-fpm /scripts
RUN echo '#!/bin/bash' > /scripts/jsdb_server.sh
RUN chmod 777 /scripts/ -R
RUN echo 'httpd -D BACKGROUND' >> /scripts/jsdb_server.sh
RUN echo 'php-fpm -D' >> /scripts/jsdb_server.sh
RUN echo 'read' >> /scripts/jsdb_server.sh
RUN chmod 555 /scripts/ -R
EXPOSE  80
CMD ["/scripts/jsdb_server.sh"]
```

#### Run the following on bash:

```sh
cd /opt/jsdb/
docker build ./ -t abd0m0hamed/jsdb:dev
docker run -itd --name JSDB -p 9050:80 -v /opt/jsdb/dev:/var/www/html abd0m0hamed/jsdb:dev
```

#### To run the application:

Open the browser > **http://localhost:9050/testing**

#### To start development:

The container's web server root **/var/www/html** is mounted to **/opt/jsdb/dev**,

So, you can start developing by updating files on **/opt/jsdb/dev**

#### Configure JSDB for Testing:

Open **app/jsdb.php** file and update config as the following:

```php
"debug_mode" => 1,

"testing_mode" => 1,

"logging" => 1,

"allow_basic_commands" => 1,
```

#### Some Docker important commands:

```bash
# Start Docker container
docker start JSDB

# Stop Docker container
docker stop JSDB

# Access Docker container using bash
docker exec -it JSDB bash

# Exit Docker container bash
exit

# Remove Docker container
docker rm JSDB

# Remove JSDB Docker image
docker rmi abd0m0hamed/jsdb:dev
```


# Directory Structure:
- **app/jsdb.php** (Main application file, also includes configuration)
- **var/data** (Database files)
- **var/log** (Log files)
- **testing** (Testing files)
- **ajax.php** (AJAX end-point to accept frontend requests)
- **index.php** (Index file including ajax.php)
- **app/custom.php** (Custom actions definition)


# Documentation:

There are two types of actions could be performed against **JSDB** API:

- **Basic Actions:** (Select, Insert, Update, Delete)
- **Custom Actions:** (You can define complex functionality by creating custom actions in **app/custom.php**)

***Note:** All AJAX requests must be sent to **ajax.php** or **index.php***

## Basic Actions:

### Insert record:

```javascript
var jsdb_query = {
    "command":"insert",
    "table":"page.View",
    "values":{"pageId" : 1, "views": 50}
}
$.ajax({
    url: ajax.php,
    data: jsdb_query,
    dataType: 'json',
    method: 'post'
}).done(function(data){
    document.body.innerHTML = JSON.stringify(data);
})
```
### Select records:

```javascript
var jsdb_query = {
    "command":"select",
    "table":"page.View",
    "columns": ["pageId", "views"],
    "where": [["pageId", "==", 50]]
}
$.ajax({
    url: ajax.php,
    data: jsdb_query,
    dataType: 'json',
    method: 'post'
}).done(function(data){
    document.body.innerHTML = JSON.stringify(data);
})
```

### Select all records:

```javascript
var jsdb_query = {
    "command":"select",
    "table":"page.View"
}
$.ajax({
    url: ajax.php,
    data: jsdb_query,
    dataType: 'json',
    method: 'post'
}).done(function(data){
    document.body.innerHTML = JSON.stringify(data);
})
```

### Update records:

```javascript
var jsdb_query = {
    "command":"update",
    "table":"page.View",
    "values": {"views":50},
    "where":[
        ["pageId", "==", 1],
        ["and", "views", "==", 50]
    ]
}
$.ajax({
    url: ajax.php,
    data: jsdb_query,
    dataType: 'json',
    method: 'post'
}).done(function(data){
    document.body.innerHTML = JSON.stringify(data);
})
```

### Update all records:

```javascript
var jsdb_query = {
    "command":"update",
    "table":"page.View",
    "values": {"views":"500"}
}
$.ajax({
    url: ajax.php,
    data: jsdb_query,
    dataType: 'json',
    method: 'post'
}).done(function(data){
    document.body.innerHTML = JSON.stringify(data);
})
```

### Delete records:

```javascript
var jsdb_query = {
    "command":"delete",
    "table":"page.View",
    "where":[
        ["pageId", "==", 3],
        ["or", "pageId", ">=", 10]
    ]
}
$.ajax({
    url: ajax.php,
    data: jsdb_query,
    dataType: 'json',
    method: 'post'
}).done(function(data){
    document.body.innerHTML = JSON.stringify(data);
})
```

### Delete all records:

```javascript
var jsdb_query = {
    "command":"delete",
    "table":"page.View"
}
$.ajax({
    url: ajax.php,
    data: jsdb_query,
    dataType: 'json',
    method: 'post'
}).done(function(data){
    document.body.innerHTML = JSON.stringify(data);
})
```

## Define custom Actions:

- Open **custom.php**
- Create a function with any name you like
- Action function must start with **"action_"**, otherwise it will not be available for external calls
- Write your custom query
- Send response to the browser using **$JSDB->response** object

## Custom Actions Examples:

### Insert Record:

```php
function action_addUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")->insert([
        "name" => $JSDB->getParam("name"),
        "email" => $JSDB->getParam("email"),
        "password" => md5($JSDB->getParam("password"))
    ]);
    $JSDB->response->addMessage("User Added", "info")->setData(1)->send();
}
```

### Add & Select Record:

```php
function action_addGetUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")->insert([
        "name" => $JSDB->getParam("name"),
        "email" => $JSDB->getParam("email"),
        "password" => md5($JSDB->getParam("password"))
    ])->select()->fetchAll();
    $JSDB->response->addMessage("User Added", "info")->setData($data)->send();
}
```

### Get User:

```php
function action_getUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")
    ->where("name", "==", $JSDB->getParam("name"))
    ->select()->fetchAll();
    $JSDB->response->addMessage("User Info", "info")->setData($data)->send();
}
```

### Get All Users:

```php
function action_getUsers(){
    global $JSDB;
    $data = $JSDB->schema->table("user")->select()->fetchAll();
    $JSDB->response->addMessage("Users Info", "info")->setData($data)->send();
}
```

### Update User:

```php
function action_updateUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")
        ->where("name", "==", $JSDB->getParam("name"))
        ->update(["email"=>$JSDB->getParam("email")]);
    $JSDB->response->addMessage("User Updated", "info")->setData(1)->send();
}
```

### Update & Get User:

```php
function action_updateGetUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")
        ->where("name", "==", $JSDB->getParam("name"))
        ->update(["email"=>$JSDB->getParam("email")])->select()->fetchAll();
    $JSDB->response->addMessage("User Updated", "info")->setData($data)->send();
}
```

### Delete User:

```php
function action_deleteUser(){
    global $JSDB;
    $data = $JSDB->schema->table("user")
    ->where("name", "==", $JSDB->getParam("name"))
    ->delete();
    $JSDB->response->addMessage("User Deleted", "info")->setData(1)->send();
}
```

### Delete All Users:

```php
function action_deleteUsers(){
    global $JSDB;
    $data = $JSDB->schema->table("user")->delete();
    $JSDB->response->addMessage("Users Deleted", "info")->setData(1)->send();
}
```


### Send Response Syntax:

```php
$JSDB->response
    ->setError(1)
    ->setCode(565) // 565 is the error code
    ->addMessage("Exception message", "exception")
    ->addMessage("Error Message", "error")
    ->addMessage("Info Message", "info")
    ->addMessage("Warning Message", "info")
    ->setData("No Data")
    ->send();
```

### [Check Testing Files](https://github.com/Abd0M0hamed/JS-DB/tree/master/testing)
