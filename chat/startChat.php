<?php
/* ###########################################################
 * File brought to you by kkz
 * There are big ships
 * There are small ships
 * but the best ship
 * is friendship!
 * Sharing is caring... please pass this along but leave this
  ##############################################################*/
include('config.inc.php');

include('database.inc.php');

mysql_query("INSERT INTO users (inchat) values('N');");

echo mysql_insert_id();

mysql_close($con);
?>