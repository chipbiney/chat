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
$randomUserId=0;

$result      =mysql_query("SELECT * FROM chats WHERE userId = $userId ");

while ($row=mysql_fetch_array($result))
    {
    $randomUserId=$row["randomUserId"];
    }

if ($randomUserId == 0)
    {
    $result=mysql_query("SELECT * FROM users WHERE id <> $userId AND inchat like 'N' ORDER BY RAND() LIMIT 1");

    while ($row=mysql_fetch_array($result))
        {
        $randomUserId=$row["id"];
        }

    if ($randomUserId != 0)
        {
        mysql_query("INSERT INTO chats (userId,randomUserId) values($userId, $randomUserId) ");
        mysql_query("INSERT INTO chats (userId,randomUserId) values($randomUserId, $userId) ");

        mysql_query("UPDATE users SET inchat='Y' WHERE id = $userId ");
        mysql_query("UPDATE users SET inchat='Y' WHERE id = $randomUserId ");
        }
    }

echo $randomUserId;
mysql_close($con);
?>