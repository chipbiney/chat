<?php
/* ###########################################################
 * File brought to you by kkz
 * There are big ships
 * There are small ships
 * but the best ship
 * is friendship!
 * Sharing is caring... please pass this along but leave this
  ##############################################################*/
$con=mysql_connect($host, $user, $pass);

if (!$con)
    {
    die ('Could not connect: ' . mysql_error());
    }

mysql_select_db($db, $con);
?>