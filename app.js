var mysql = require("mysql");

var connection = mysql.createConnection({
    host: 'wadproject2021.cpukmprutvtu.ap-southeast-1.rds.amazonaws.com',
    port: '3306',
    user: 'admin',
    password:'aplusproject',
    database:'wadproject2021'
    
    
    
    
})

connection.connect(function(err){
    if (err)
 {
     
     console.error('Databse connection fail: ' + err.stock );
     return;
     
 }
 
 console.log("connected  to databse");
 var q = "select * from users";
 connection.query(q,function(err,results){
     if (err) throw err;
     console.log(results);
     connection.end();
 });
 })
 
 
