<?php
# Type="MYSQL"
# HTTP="true"



$hostname_n12 = "normatiza.app";
//$hostname_wpolpa = "localhost";
$database_n12 = "normatiz_nr12";
$username_n12 = "normatiz_root";
$password_n12 = "@Bernardo2017";
//$n12 = mysql_pconnect($hostname_n12, $username_n12, $password_n12, $da) or trigger_error(mysql_error(),E_USER_ERROR); 

$n12 = mysqli_connect($hostname_n12, $username_n12, $password_n12, $database_n12); 


if (mysqli_connect_errno()){
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 
?>
