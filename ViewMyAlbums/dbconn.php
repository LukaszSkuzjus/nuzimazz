<?php
 
    global $db;

//Connect to the database. (host,username,password,database)

$db = new mysqli('localhost', 'root', '', 'album'); 



// Report connection error.
if (mysqli_connect_errno()) {
die('Connect failed: Database server is down. Please be patient while it\'s restored.');
}




?>