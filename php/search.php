<?php 
    include_once "config.php";
    $searchTerm = mysqli_real_escape_string($conn, $_POST[]);
    $output = "";
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE fname LIKE '%{$searchTerm}%' OR lname LIKE '${searchTerm}%'");
    if(mysqli_nums_rows($sql) > 0){
        include "data.php";
    }else{
        $output .= "No user found related to your search term";
    }
    echo $output;
?>