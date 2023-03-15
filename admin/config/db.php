<?php 
$host="localhost";
$db="book-website";
$user="root";
$password="";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db",$user,$password);
    // if($conn){echo "Database connection successfuly";}
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>