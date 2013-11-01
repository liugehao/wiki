<?php
 
/*
 
 *  Hello World client
 
 *  Connects REQ socket to tcp://localhost:5555
 
 *  Sends "Hello" to server, expects "World" back
 
 * @author Ian Barber &lt;ian(dot)barber(at)gmail(dot)com>
 
 */
function time1(){
    list($a, $b) = explode(" ", microtime());
    return ((float)$a + (float)$b);
}
$start_time = time1();
$count = 100000;
$sucesscount = 0;
$context = new ZMQContext();
 
//  Socket to talk to server
 
echo "Connecting to hello world server...\n";
 
$requester = new ZMQSocket($context, ZMQ::SOCKET_REQ);
 
$requester->connect("tcp://localhost:5555");
 
for($request_nbr = 0; $request_nbr != $count; $request_nbr++) {
 
    //printf ("Sending request %d...\n", $request_nbr);
 
    $requester->send("Hello");
 
    $reply = $requester->recv();

    if($reply == "World")$sucesscount ++;
    //printf ("Received reply %d: [%s]\n", $request_nbr, $reply);
 
}

echo "\nseconds for send {$count} times 'hello' :" .  (time1()- $start_time)."\n sucesscount:{$sucesscount}";
