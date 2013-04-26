<?php

//it is a good practice to indicate the username,passowrd
//and db at the start so as to
//enable the change of anyone of them just by changing 1 line


$username="root";
$password="";
$database="album";

mysql_connect(localhost,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");

?>