<?php
 function getDataBaseConnection(){
   $db = new PDO('sqlite:' . __DIR__ . '/../database/database.db');
    return $db;
 }
?>