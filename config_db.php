<?php

/*$link = mysql_connect("mysql12.000webhost.com", "a9178575_baza", "baza2000")
  or die ("Could not connect: " . mysql_error());

mysql_select_db(a9178575_baza, $link)
  or die ("Could not change database: " . mysql_error());*/

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'a9178575_baza';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
        or die ("Could not connect: " . mysqli_error($conn));

?>
