<html>
    <head>
        <title>Installer Script 0.0.01 BETA</title>
    </head>

    <body>
        <p>Please make sure that config.php is set to 666 (or higher) permissions as so this file can read and write
        to it. :) Thank you!</p>

        <form action = "" method = "post" name = "write" id = "write">
            Database User <input name = "db_user" type = "text" id = "db_user">

            <br>
            Database Password <input name = "db_pass" type = "text" id = "db_pass">

            <br>
            Database <input name = "db_data" type = "text" id = "db_data">

            <br>
            Host <input name = "db_host" type = "text" id = "db_host" value = "localhost">

            <br>
            Website Title <input name = "title" type = "text" id = "title">

            <br>
            <input type = "submit" name = "Submit" value = "Submit">
        </form>
    </body>
</html>

<?php
if ($_POST['Submit'])
    {
    extract ($_POST);

    $con=mysql_connect($db_host, $db_user, $db_pass);

    if (!$con)
        {
        die ('Could not connect: ' . mysql_error());
        }

    mysql_close ($con);
    echo "please exicute the following in MySQL";
?><blockquote>
<?php
    echo
        "-- phpMyAdmin SQL Dump
\n-- version 3.1.3.1
\n-- http://www.phpmyadmin.net
\n--
\n-- Host: localhost
\n-- Generation Time: Sep 21, 2009 at 03:33 AM
\n-- Server version: 5.1.33
\n-- PHP Version: 5.2.9-2
\n
\nSET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";
\n
\n
\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
\n/*!40101 SET NAMES utf8 */;
\n
\n--
\n-- Database: `omegle`
\n--
\n
\n-- --------------------------------------------------------
\n
\n--
\n-- Table structure for table `chats`
\n--
\n
\nCREATE TABLE IF NOT EXISTS `chats` (
\n  `userId` int(11) NOT NULL,
\n  `randomUserId` int(11) NOT NULL
\n) ENGINE=MyISAM DEFAULT CHARSET=latin1;
\n
\n--
\n-- Dumping data for table `chats`
\n--
\n
\n
\n-- --------------------------------------------------------
\n
\n--
\n-- Table structure for table `msgs`
\n--
\n
\nCREATE TABLE IF NOT EXISTS `msgs` (
\n  `id` int(11) NOT NULL AUTO_INCREMENT,
\n  `userId` int(11) DEFAULT NULL,
\n  `randomUserId` int(11) DEFAULT NULL,
\n  `msg` text,
\n  `sentdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
\n  PRIMARY KEY (`id`)
\n) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=261 ;
\n
\n--
\n-- Dumping data for table `msgs`
\n--
\n
\n
\n-- --------------------------------------------------------
\n
\n--
\n-- Table structure for table `oldmsgs`
\n--
\n
\nCREATE TABLE IF NOT EXISTS `oldmsgs` (
\n  `id` int(11) NOT NULL AUTO_INCREMENT,
\n  `userId` int(11) NOT NULL,
\n  `randomUserId` int(11) NOT NULL,
\n  `msg` text NOT NULL,
\n  `archivedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
\n  PRIMARY KEY (`id`)
\n) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
\n
\n--
\n-- Dumping data for table `oldmsgs`
\n--
\n
\nINSERT INTO `oldmsgs` (`id`, `userId`, `randomUserId`, `msg`, `archivedDate`) VALUES
\n(1, 423, 423, 'hiiiiiiiiiiiii', '2009-09-21 03:29:04'),
\n(2, 424, 424, 'hello', '2009-09-21 03:29:10'),
\n(3, 423, 423, 'hiiiiiiiiiii', '2009-09-21 03:29:17'),
\n(4, 423, 423, 'hiiiiiiiiii', '2009-09-21 03:30:14'),
\n(5, 424, 424, 'Helloooooooooooo', '2009-09-21 03:30:23');
\n
\n-- --------------------------------------------------------
\n
\n--
\n-- Table structure for table `typing`
\n--
\n
\nCREATE TABLE IF NOT EXISTS `typing` (
\n  `id` int(11) NOT NULL
\n) ENGINE=MyISAM DEFAULT CHARSET=latin1;
\n
\n--
\n-- Dumping data for table `typing`
\n--
\n
\nINSERT INTO `typing` (`id`) VALUES
\n(294),
\n(299),
\n(321),
\n(332),
\n(340),
\n(360),
\n(402),
\n(410),
\n(411);
\n
\n-- --------------------------------------------------------
\n
\n--
\n-- Table structure for table `users`
\n--
\n
\nCREATE TABLE IF NOT EXISTS `users` (
\n  `id` int(11) NOT NULL AUTO_INCREMENT,
\n  `inchat` char(1) NOT NULL,
\n  PRIMARY KEY (`id`)
\n) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=426 ;
\n
\n--
\n-- Dumping data for table `users`
\n-- ";
?></blockquote>
<?php
    $file_to_write='config.inc.php';

    $content.="<?php\n";
    $content.="\$host = '$db_host';\n";
    $content.="\$user = '$db_user';\n";
    $content.="\$pass = '$db_pass';\n";
    $content.="\$db = '$db_data';\n";
    $content.="\$title = '$title';\n";
    $content.="?>";

    $fp=fopen($file_to_write, 'w');
    fwrite($fp, $content);
    fclose ($fp);
    echo "Success!";
    echo "$file_to_write";
    echo "Has been written.";
    }
?>