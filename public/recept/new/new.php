<?php session_start();
    require_once("../../private/database.php");
    $Database = new Database;
    $title = $_POST["Title"];


    $Database->insert("INSERT INTO recepten(recept) 
            VALUES ('?'?''?'')");

    mysqli_query(,)
?>