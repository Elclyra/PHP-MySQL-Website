<?php 

// Connect to database
$conn = mysqli_connect("localhost", "edvard", "test1234", "product_page");
//Check connection
if(!$conn){
    echo "Connection error: " . mysqli_connect_error();
}

?>