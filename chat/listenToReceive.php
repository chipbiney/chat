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

$msg   ="";
$randomUserId;

include ('config.inc.php');
include ('database.inc.php');
$result=mysql_query("SELECT * FROM chats WHERE userId = $userId ");

if (mysql_num_rows($result) > 0)
    {
    $result=mysql_query("SELECT * FROM msgs WHERE randomUserId = $userId ORDER BY sentdate limit 1");

    $id    =0;

    while ($row=mysql_fetch_array($result))
        {
        $id          = $row["id"];
        $msg         =$row["msg"];
        $randomUserId=$row["userId"];
        }

    if ($id != 0)
        {
        mysql_query ("DELETE FROM msgs WHERE id = $id ");
        mysql_query ("INSERT INTO oldMsgs(userId,randomUserId,msg) VALUES( $randomUserId,$userId,'$msg'); ");
        }
    }
else
    {
    echo "||--noResult--||";
    }

mysql_close ($con);

echo $msg;
?>