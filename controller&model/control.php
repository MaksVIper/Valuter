<?php

require "model.php";
$preTime = date("d.m.Y",time()-(60*60*24));
$link = "http://www.cbr.ru/scripts/XML_daily.asp";
$link2 = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=$preTime";
$arr = array();
$arrPre = array();

$obj = new Model();
$obj->getValuteXML($link,$link2,$preTime);
$obj->printInfo();


?>
