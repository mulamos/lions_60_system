<?php

$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'lions';

$conn = mysqli_connect($host, $username, $password);//new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$db_connect = mysqli_select_db($conn, $dbname);

if($conn){
        if($db_connect){
                return $conn;
        }else{
                header('Location: https://lions-60-system-rand2016.c9users.io/error/error.html?msg=Unable to connect to DB');
        }
}else{
        header('Location: https://lions-60-system-rand2016.c9users.io/error/error.html?msg=Unable to connect to server');//direct user to contact admin page
}

?>