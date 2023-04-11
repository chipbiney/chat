<?php
include ('config.inc.php');
?>

<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
        <?php
        echo ($title);
        ?>

        </title>

        <link type = "text/css" rel = "stylesheet" href = "Omegle_files/style.css">
        <script>
            var xmlHttp;

            var xmlHttp2;
            var xmlHttp3;
            var xmlHttp4;
            var xmlHttp5;
            var xmlHttp6;
            var xmlHttp7;
            var xmlHttp8;
            var xmlHttp9;
            var xmlHttp10;

            var userId = 0;
            var strangerId = 0;
            var playTitleFlag = false;

            // Generic function to create xmlHttpRequest for any browser //
            function GetXmlHttpObject()
                {
                var xmlHttp = null;

                try
                    {
                    // Firefox, Opera 8.0+, Safari
                    xmlHttp = new XMLHttpRequest();
                    }
                catch (e)
                    {
                    //Internet Explorer
                    try
                        {
                        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
                        }
                    catch (e)
                        {
                        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                    }

                return xmlHttp;
                }


            // Ajax part to get number of online chat //
            function getNumberOfOnlineUsers()
                {
                xmlHttp = GetXmlHttpObject();

                if (xmlHttp == null)
                    {
                    alert("Browser does not support HTTP Request");
                    return;
                    }

                var url = "getNumberOfUsers.php";
                xmlHttp.open("POST", url, true);
                xmlHttp.onreadystatechange = stateChanged;
                xmlHttp.send(null);
                }

            function stateChanged()
                {
                if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
                    {
                    var count = xmlHttp.responseText;
                    document.getElementById("onlinecount").innerHTML = count + " đang online";
                    window.setTimeout("getNumberOfOnlineUsers();", 2000);
                    }
                }

            // End of get number of online users//

            // Ajax part start chat //
            function startChat()
                {
                xmlHttp2 = GetXmlHttpObject();

                if (xmlHttp2 == null)
                    {
                    alert("Browser does not support HTTP Request");
                    return;
                    }

                var url = "startChat.php";
                xmlHttp2.open("POST", url, true);
                xmlHttp2.onreadystatechange = stateChanged2;
                xmlHttp2.send(null);
                }

            function stateChanged2()
                {
                if (xmlHttp2.readyState == 4 || xmlHttp2.readyState == "complete")
                    {
                    userId = trim(xmlHttp2.responseText);

                    document.getElementById("chatbox").style.display = 'block';
                    document.getElementById("sendbtn").disabled = true;
                    document.getElementById("chatmsg").disabled = true;
                    document.getElementById("disconnectbtn").disabled = true;

                    document.getElementById("intro").style.display = 'none';
                    document.getElementById("sayHi").style.display = 'none';

                    if (document.getElementById("chatDisconnected") != undefined)
                        document.getElementById("chatDisconnected").style.display = 'none';

                    if (document.getElementById("startNew") != undefined)
                        document.getElementById("startNew").style.display = 'none';

                    randomChat();
                    }
                }

            // End of start chat//

            // Ajax part leave chat //
            function leaveChat()
                {
                playTitleFlag = false;
                xmlHttp3 = GetXmlHttpObject();

                if (xmlHttp3 == null)
                    {
                    alert("Browser does not support HTTP Request");
                    return;
                    }

                var url = "leaveChat.php?userId=" + userId;
                xmlHttp3.open("POST", url, true);
                xmlHttp3.onreadystatechange = stateChanged3;
                xmlHttp3.send(null);
                }

            function stateChanged3()
                {
                }

            // End of leave chat//

            // Ajax part random chat //
            function randomChat()
                {
                xmlHttp4 = GetXmlHttpObject();

                if (xmlHttp4 == null)
                    {
                    alert("Browser does not support HTTP Request");
                    return;
                    }

                var url = "randomChat.php?userId=" + userId;
                xmlHttp4.open("POST", url, true);
                xmlHttp4.onreadystatechange = stateChanged4;
                xmlHttp4.send(null);
                }

            function stateChanged4()
                {
                if (xmlHttp4.readyState == 4 || xmlHttp4.readyState == "complete")
                    {
                    strangerId = trim(xmlHttp4.responseText);

                    if (strangerId != "0")
                        {
                        document.getElementById("sendbtn").disabled = false;
                        document.getElementById("chatmsg").disabled = false;
                        document.getElementById("disconnectbtn").disabled = false;
                        document.getElementById("sayHi").style.display = 'block';
                        document.getElementById("connecting").style.display = 'none';
                        document.getElementById("looking").style.display = 'none';

                        listenToReceive();
                        isTyping();
                        }

                    else
                        {
                        window.setTimeout("randomChat();", 2000);
                        }
                    }
                }

            // End of random chat//

            // Ajax part random chat //
            function listenToReceive()
                {
                xmlHttp5 = GetXmlHttpObject();

                if (xmlHttp5 == null)
                    {
                    alert("Browser does not support HTTP Request");
                    return;
                    }

                var url = "listenToReceive.php?userId=" + userId;
                xmlHttp5.open("POST", url, true);
                xmlHttp5.onreadystatechange = stateChanged5;
                xmlHttp5.send(null);
                }

            function stateChanged5()
                {
                if (xmlHttp5.readyState == 4 || xmlHttp5.readyState == "complete")
                    {
                    var msg = xmlHttp5.responseText;

                    if (trim(msg) == "||--noResult--||")
                        {
                        // other party is disconnected//
                        document.getElementById("sendbtn").disabled = true;
                        document.getElementById("chatmsg").disabled = true;
                        document.getElementById("disconnectbtn").disabled = true;
                        document.getElementById("sayHi").style.display = 'none';
                        document.getElementById("chatDisconnected").style.display = 'block';
                        document.getElementById("logbox").innerHTML
                            += "<div id='startNew' class='logitem'><div><br><input value='Bắt đầu chat lại' onclick='startNewChat();' type='button' class='startnewconver'> hoặc <a href='#' onclick='saveLog();'>lưu log chat</a></div></div>";
                        document.getElementById("logbox").scrollTop = document.getElementById("logbox").scrollHeight;
                        leaveChat();

                        return;
                        }

                    else if (trim(msg) != "" && msg != undefined)
                        {
                        // Message received //
                        document.getElementById("logbox").innerHTML
                            += "<div class='logitem'><div class='strangermsg'><span class='msgsource'>Người lạ: </span>"
                                   + msg + "</div></div>";
                        document.getElementById("logbox").scrollTop = document.getElementById("logbox").scrollHeight;

                        playTitleFlag = true;
                        playTitle();
                        }

                    window.setTimeout("listenToReceive();", 2000);
                    }
                }

            // End of random chat//

            // Ajax part send chat message //
            function sendMsg()
                {
                var msg = document.getElementById("chatmsg").value;

                if (trim(msg) != "")
                    {
                    appendMyMessage();
                    xmlHttp6 = GetXmlHttpObject();

                    if (xmlHttp6 == null)
                        {
                        alert("Browser does not support HTTP Request");
                        return;
                        }

                    document.getElementById("chatmsg").value = "";
                    var url = "sendMsg.php?userId=" + userId + "&strangerId=" + strangerId + "&msg=" + msg;
                    xmlHttp6.open("POST", url, true);
                    xmlHttp6.onreadystatechange = stateChanged6;
                    xmlHttp6.send(null);
                    }
                }

            function stateChanged6()
                {
                }

            // End of send chat message//

            //function to append my message to the chat area//
            function appendMyMessage()
                {
                var msg = document.getElementById("chatmsg").value;

                if (trim(msg) != "")
                    {
                    document.getElementById("logbox").innerHTML
                        += "<div class='logitem'><div class='youmsg'><span class='msgsource'>Bạn: </span> " + msg
                               + "</div></div>";
                    document.getElementById("logbox").scrollTop = document.getElementById("logbox").scrollHeight;
                    }
                }

            //function to disconnect
            function disconnect()
                {
                var flag = confirm("Are you sure you want to be disconnected from this chat?");

                if (flag)
                    {
                    leaveChat();
                    document.getElementById("sendbtn").disabled = true;
                    document.getElementById("chatmsg").disabled = true;
                    document.getElementById("disconnectbtn").disabled = true;

                    document.getElementById("sayHi").style.display = 'none';
                    document.getElementById("chatDisconnected").style.display = 'block';
                    }
                }

            //function to send on pressing Enter Key//
            function tryToSend(event)
                {
                var key = event.keyCode;

                if (key == "13")
                    {
                    sendMsg();
                    return;
                    }

                var msg = document.getElementById("chatmsg").value;

                if (trim(msg) != "")
                    {
                    typing();
                    }

                else
                    {
                    stopTyping();
                    }
                }


            // Ajax part to indicat user is typing //
            function typing()
                {
                xmlHttp7 = GetXmlHttpObject();

                if (xmlHttp7 == null)
                    {
                    alert("Browser does not support HTTP Request");
                    return;
                    }

                var url = "typing.php?userId=" + userId;
                xmlHttp7.open("POST", url, true);
                xmlHttp7.onreadystatechange = stateChanged7;
                xmlHttp7.send(null);
                }

            function stateChanged7()
                {
                if (xmlHttp7.readyState == 4 || xmlHttp7.readyState == "complete")
                    {
                    }
                }

            // End of indicat user is typing //


            // Ajax part to indicat user is not typing //
            function stopTyping()
                {
                xmlHttp8 = GetXmlHttpObject();

                if (xmlHttp8 == null)
                    {
                    alert("Browser does not support HTTP Request");
                    return;
                    }

                var url = "stopTyping.php?userId=" + userId;
                xmlHttp8.open("POST", url, true);
                xmlHttp8.onreadystatechange = stateChanged8;
                xmlHttp8.send(null);
                }

            function stateChanged8()
                {
                if (xmlHttp8.readyState == 4 || xmlHttp8.readyState == "complete")
                    {
                    }
                }

            // End of indicat user is not typing //

            // Ajax to see if stranger is typing//
            function isTyping()
                {
                xmlHttp9 = GetXmlHttpObject();

                if (xmlHttp9 == null)
                    {
                    alert("Browser does not support HTTP Request");
                    return;
                    }

                var url = "isTyping.php?strangerId=" + strangerId;
                xmlHttp9.open("POST", url, true);
                xmlHttp9.onreadystatechange = stateChanged9;
                xmlHttp9.send(null);
                }

            function stateChanged9()
                {
                if (xmlHttp9.readyState == 4 || xmlHttp9.readyState == "complete")
                    {
                    if (trim(xmlHttp9.responseText) == "typing")
                        {
                        //alert("stranger is typing");
                        document.getElementById("typing").style.display = 'block';
                        }

                    else
                        {
                        document.getElementById("typing").style.display = 'none';
                        }

                    window.setTimeout("isTyping();", 2000);
                    }
                }

            //Ajax to see if stranger is typing//

            // to start new chat //
            function startNewChat()
                {
                document.getElementById("logbox").innerHTML = "";
                document.getElementById("logbox").innerHTML
                    = "<div id='connecting' class='logitem'><div class='statuslog'>Đang kết nối với máy chủ..</div></div><div id='looking' class='logitem'><div class='statuslog'>Bạn chờ tý nhé, đang tìm kiếm Người lạ.</div></div><div id='sayHi' class='logitem'><div class='statuslog'>Bạn đang chat với Người lạ. Nói \"Xin chào!\" để bắt đầu..</div></div><div id='chatDisconnected' class='logitem'><div class='statuslog'>Người lạ đã thoát.</div></div>";
                startChat();
                }

            // function to trim strings
            function trim(sVal)
                {
                var sTrimmed = "";

                for (i = 0; i < sVal.length; i++)
                    {
                    if (sVal.charAt(i) != " " && sVal.charAt(i) != "\f" && sVal.charAt(i) != "\n" && sVal.charAt(i)
                                                                                                         != "\r"
                        && sVal.charAt(i) != "\t")
                        {
                        sTrimmed = sTrimmed + sVal.charAt(i);
                        }
                    }

                return sTrimmed;
                }

            // function to play title //
            function playTitle()
                {
                document.title = "Chat voi nguoi la";
                window.setTimeout('document.title="Chat voi nguoi la";', 1000);
                window.setTimeout('document.title="Ban co tin nhan moi";', 2000);
                // window.setTimeout('document.title="Hay xem ho noi gi";', 3000);

                if (playTitleFlag == true)
                    {
                    window.setTimeout('playTitle();', 4000);
                    }
                }

            // function to detect if browser has focus
            window.onfocus = function()
                {
                playTitleFlag = false;
                }


            // Ajax part to save log //
            function saveLog()
                {
                xmlHttp10 = GetXmlHttpObject();

                if (xmlHttp10 == null)
                    {
                    alert("Browser does not support HTTP Request");
                    return;
                    }

                var url = "saveLog.php?userId=" + userId + "&strangerId=" + strangerId;
                xmlHttp10.open("POST", url, true);
                xmlHttp10.onreadystatechange = stateChanged10;
                xmlHttp10.send(null);
                }

            function stateChanged10()
                {
                if (xmlHttp10.readyState == 4 || xmlHttp10.readyState == "complete")
                    {
                    var log = xmlHttp10.responseText;
                    var generator = window.open('', '', 'height=400,width=500,top=100,left=100');
                    generator.document.write('<html><head><title>Log File</title>');
                    generator.document.write('<link type="text/css" rel="stylesheet" href="Omegle_files/style.css">');
                    generator.document.write('</head><body>');
                    generator.document.write(log);
                    generator.document.write('</body></html>');
                    generator.document.close();
                    }
                }
            // End of save log//

        </script>
    </head>

    <body onload = "getNumberOfOnlineUsers();" onbeforeunload = "leaveChat();">
        <div id = "header">
            <h1 id = "logo"><img src = "Omegle_files/logo.png" alt = "Omegle" width = "236" height = "57"></h1>
            <div id = "onlinecount">
            </div>
        </div>

        <div id = "intro">
            <p>Chat với người lạ là nơi bạn có thể làm quen với những người bạn mới, 
			chia sẻ những mẩu chuyện, những tâm sự, những ý tưởng hay chỉ đơn giản là giải trí.</p>

            <p id = "chatbutton"><img src = "Omegle_files/chatbutton.png" onclick = "startChat();"
                                      alt = "Start a chat"></p>
        </div>
		
        <div class = "chatbox" id = "chatbox" style = "display:none;">
            <div style = "top: 90px;" class = "logwrapper">
                <div class = "logbox" id = "logbox">
                    <div id = "connecting" class = "logitem">
                        <div class = "statuslog">Đang kết nối với máy chủ...
                        </div>
                    </div>

                    <div id = "looking" class = "logitem">
                        <div class = "statuslog">Tìm kiếm người lạ ngẫu nhiên..
                        </div>
                    </div>

                    <div id = "sayHi" class = "logitem">
                        <div class = "statuslog">Bạn đang chat với Người lạ. Nói "Xin chào!" để bắt đầu..
                        </div>
                    </div>

                    <div id = "chatDisconnected" class = "logitem">
                        <div class = "statuslog">Người lạ đã thoát.
                        </div>
                    </div>

                    <div id = "startNew" class = "logitem">
                        <div><br><input value = "Bắt đầu chat lại" onclick = "randomChat();" type = "button"> hoặc
                        <a href = "#">Lưu log chat</a>.
                        </div>
                    </div>
                </div>
            </div>

            <div class = "controlwrapper">
                <div id = "typing" style = "display:none;" class = "logitem">
                    <div class = "statuslog">Người lạ đang viết...
                    </div>
                </div>
					<input disabled = "disabled"     value = "Disconnect" style = "cursor:pointer;"
						   onclick = "disconnect();" id = "disconnectbtn" class = "disconnectbtn"
						   type = "button">
					<textarea disabled = "enabled" placeholder="Gõ tin nhắn..." 
							  onblur = "stopTyping();"
							  onfocus = "playTitleFlag=false; window.title='Omegle';"
							  onkeypress = "tryToSend(event);"
							  id = "chatmsg"
							  rows = "3"
							  cols = "80"
							  class = "chatmsg"></textarea>
				<input disabled = "disabled"  style = "cursor:pointer;"
													 value = "Send"         id = "sendbtn"
													 onclick = "sendMsg();" class = "sendbtn"
													 type = "button">
            </div>
        </div>
    </body>
</html>