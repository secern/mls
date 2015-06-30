<?php
/*
*  Hello World client
*  Connects REQ socket to tcp://localhost:5555
*  Sends "Hello" to server, expects "World" back
* @author Ian Barber <ian(dot)barber(at)gmail(dot)com>
*/


ini_set("display_errors", true);

$conn = new mysql_connect("localhost", "root", "123456");
mysql_select_db("test", $conn);
mysql_query("set names 'utf-8'");

$context = new ZMQContext();

//  Socket to talk to server
echo "Connecting to hello world server…\n";
ob_flush();
flush();
$requester = new ZMQSocket($context, ZMQ::SOCKET_REQ);
$requester->connect("tcp://192.168.1.79:5555");

for ($request_nbr = 0; $request_nbr != 10; $request_nbr++) {
    printf ("Sending request %d…\n", $request_nbr);
ob_flush();
flush();
    $requester->send("Hello");

    mysql_query("insert into test.test(content) values('hello')");

    $reply = $requester->recv();
    mysql_query("insert into test.test(content) values('reply')");
    printf ("Received reply %d: [%s]\n", $request_nbr, $reply);
ob_flush();
flush();
}