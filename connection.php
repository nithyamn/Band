<?php
$server="localhost";
$username="root";
$password="";
$db="band";
$conn=mysqli_connect($server,$username,$password,$db);
if(!$conn)
    echo "Error".mysqli_error();
?>