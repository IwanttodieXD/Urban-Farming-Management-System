<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "QCU-CUAI"; //ditabis name dire

$conn = mysqli_connect($server,$username,$password,$database);
 try {
    if(!$conn){
        echo "Connection Failed!",mysqli_connect_error();
    }else{
        // echo "Connection Establish";
    }
 }catch (Exception $e) {
    echo "can't connect to database";
 }
?>