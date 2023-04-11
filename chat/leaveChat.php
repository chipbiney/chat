<?php
/* ###########################################################
 * File brought to you by kkz
 * There are big ships
 * There are small ships
 * but the best ship
 * is friendship!
 * Sharing is caring... please pass this along but leave this
  ##############################################################*/

$userId=$_REQUEST["userId"];

include('config.inc.php');
include('database.inc.php');

mysql_query("DELETE FROM users WHERE id = $userId ;");

mysql_query("DELETE FROM chats WHERE userId = $userId ;");

mysql_query("DELETE FROM chats WHERE randomUserId = $userId ;");

mysql_close($con);
?>