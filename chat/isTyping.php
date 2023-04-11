<?php
/* ###########################################################
 * File brought to you by kkz
 * There are big ships
 * There are small ships
 * but the best ship
 * is friendship!
 * Sharing is caring... please pass this along but leave this
  ##############################################################*/

$strangerId=$_REQUEST["strangerId"];

include ('config.inc.php');
include ('database.inc.php');

$result    =mysql_query("SELECT * FROM typing WHERE id=$strangerId ;");

while ($row=mysql_fetch_array($result))
    {
    echo "typing";
    }

mysql_close ($con);
?>