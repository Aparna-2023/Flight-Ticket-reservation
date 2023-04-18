<?php
$dsn="mysql:host=localhost;dbname=afrs";
$user="root";
$password="";
$options=[];
try{
    
    $connection=new PDO($dsn,$user,$password,$options);
    // echo "Connection successful";
}
catch(PDOException){
    echo "connection error!";
}
?>