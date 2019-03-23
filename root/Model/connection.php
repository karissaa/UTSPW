<?php
    $host = "localhost";
    $dbname = "pemweb";
    $username = "root";
    $password = "";

    //$db = new mysqli($hostname,$username,$password,$dbname);
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>