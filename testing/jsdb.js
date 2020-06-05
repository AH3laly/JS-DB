var JSDB = {};
JSDB.API = "../../ajax.php";
JSDB.log = function(messages){
    var styles = [
        "border:solid 1px red",
        "background-color: #f9e4e4",
        "border-radius: 5px",
        "padding: 10px",
        "margin: 10px 20px",
        "font-size: 12px",
        "line-height: 20px"
    ];
    if(!Array.isArray(messages)){
        messages = [messages];
    }
    var logDiv = $('<div></div>').attr("style", styles.join(";")).html(messages.join('<br /><br />'));
    $("body").append(logDiv);
};
// Basic Commands
JSDB.insert = function(pageId){
    var jsdb_query = {
        "command":"insert",
        "table":"page.View",
        "values":{"pageId" : pageId, "views": 50}
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
};
JSDB.select = function(){
    var jsdb_query = {
        "command":"select",
        "table":"page.View",
        "columns": ["pageId", "views"],
        "where": [["pageId", "==", 1]]
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
};
JSDB.selectAll = function(){
    var jsdb_query = {
        "command":"select",
        "table":"page.View"
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
};
JSDB.update = function(){
    var jsdb_query = {
        "command":"update",
        "table":"page.View",
        "values": {"views":150},
        "where":[
            ["pageId", "==", 1],
            ["and", "views", "==", 50]
        ]
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
};
JSDB.updateAll = function(){
    var jsdb_query = {
        "command":"update",
        "table":"page.View",
        "values": {"views":"500"}
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
};
JSDB.delete = function(){
    var jsdb_query = {
        "command":"delete",
        "table":"page.View",
        "where":[
            ["pageId", "==", 1],
            ["or", "pageId", ">=", 4]
        ]
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
};
JSDB.deleteAll = function(){
    var jsdb_query = {
        "command":"delete",
        "table":"page.View"
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
};

// Custom Commands
JSDB.addUser = function(){
    var jsdb_query = {
        "command":"addUser",
        "name":"AbdelrahmanHelaly",
        "email": "abdo@yahoo.com",
        "password": "SDksdjsdKSDOSDksdllDFsdk"
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
}
JSDB.addGetUser = function(){
    var jsdb_query = {
        "command":"addGetUser",
        "name":"ahmed Mohamed",
        "email": "ahmed@yahoo.com",
        "password": "sd5ewsz68wd4g6fds5a"
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
}
JSDB.updateUser = function(){
    var jsdb_query = {
        "command":"updateUser",
        "name":"abdo",
        "email":"helaly@yahoo.com"
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
}
JSDB.updateGetUser = function(){
    var jsdb_query = {
        "command":"updateGetUser",
        "name":"abdo",
        "email":"abdohelaly@yahoo.com"
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
}
JSDB.getUser = function(){
    var jsdb_query = {
        "command":"getUser",
        "name":"abdo"
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
}
JSDB.getUsers = function(){
    var jsdb_query = {
        "command":"getUsers"
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
}
JSDB.deleteUser = function(){
    var jsdb_query = {
        "command":"deleteUser",
        "name":"abdo",
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
}
JSDB.deleteUsers = function(){
    var jsdb_query = {
        "command":"deleteUsers"
    }
    $.ajax({
        url: JSDB.API,
        data: jsdb_query,
        dataType: 'json',
        method: 'post'
    }).done(function(data){
        JSDB.log([
            "<b>Executing:</b> " + JSON.stringify(jsdb_query),
            "<b>Result:</b> " + JSON.stringify(data)
        ]);
    })
}

// Start Execution
$(document).ready(function(){
    // Execute Basic commands
    setTimeout(()=>{
        JSDB.insert(1); JSDB.insert(2); JSDB.insert(3); JSDB.insert(4); JSDB.insert(5);
    }, 1000);
    setTimeout(()=> JSDB.select(), 2000);
    setTimeout(()=> JSDB.selectAll(), 3000);
    setTimeout(()=> JSDB.update(), 4000);
    setTimeout(()=> JSDB.selectAll(), 5000);
    setTimeout(()=> JSDB.updateAll(), 6000);
    setTimeout(()=> JSDB.selectAll(), 7000);
    setTimeout(()=> JSDB.delete(), 8000);
    setTimeout(()=> JSDB.selectAll(), 9000);
    setTimeout(()=> JSDB.deleteAll(), 10000);
    setTimeout(()=> JSDB.selectAll(), 11000);
    // Execute Custom Commands
    setTimeout(()=>JSDB.addUser(), 12000);
    setTimeout(()=>JSDB.getUser(), 13000);
    setTimeout(()=>JSDB.addGetUser(), 14000);
    setTimeout(()=>JSDB.getUsers(), 15000);
    setTimeout(()=>JSDB.updateUser(), 16000);
    setTimeout(()=>JSDB.updateGetUser(), 17000);
    setTimeout(()=>JSDB.getUsers(), 18000);
    setTimeout(()=>JSDB.deleteUser(), 19000);
    setTimeout(()=>JSDB.getUsers(), 20000);
    setTimeout(()=>JSDB.deleteUsers(), 21000);
    setTimeout(()=>JSDB.getUsers(), 22000);
});