<?php
$server   = "89.46.111.19:3306";
$database = "Sql974967_1";
$username = "Sql974967";
$password = "36s2607l21";

$mysqlConnection = mysql_connect($server, $username, $password);
if (!$mysqlConnection)
{
  echo "Please try later.";
}
else
{
mysql_select_db($database, $mysqlConnection);
}

?>