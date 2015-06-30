<?php
/*
*  Hello World client
*  Connects REQ socket to tcp://localhost:5555
*  Sends "Hello" to server, expects "World" back
* @author Ian Barber <ian(dot)barber(at)gmail(dot)com>
*/


ini_set("display_errors", true);

myLog("sdfsdf");

function myLog($content, $isObj = false){
    if($isObj){
        $content = serialize($content);
    }
    $logTxt = fopen(dirname(__FILE__)."/log.txt", "w");
    fwrite($logTxt, $content."\n");
}