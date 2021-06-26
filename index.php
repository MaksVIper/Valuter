
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Valuter</title>
</head>
<body>

<?php

header("Content-Type: text/html; charset=utf-8");
$preTime = date("d.m.Y",time()-(60*60*24));
$link = "http://www.cbr.ru/scripts/XML_daily.asp";
$link2 = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=$preTime";

//Массивы для заполнения значений Курса
$data = array(); 
$dataPre = array();

    $content = file_get_contents($link); 
    $contentPre = file_get_contents($link2); 
    $dom = new domDocument("1.0", "cp1251"); 
    $dom->loadXML($content); 
    $root = $dom->documentElement; 
    $xml = simplexml_load_string($content);
    $dom->loadXML($contentPre);
    $root = $dom->documentElement;
    $xmlPre = simplexml_load_string($contentPre);

    foreach($xml->Valute as $item) 
    {
    $data[(string)$item->CharCode] = str_replace(',','.',$item->Value);
    }

    foreach($xmlPre->Valute as $item) 
    {
    $dataPre[(string)$item->CharCode] = str_replace(',','.',$item->Value);
    }



foreach ($data as $key => $value) {
    foreach ($dataPre as $keyPre => $valuePre) {
        if($key == $keyPre)
        {
            
        $s = <<< LABEL
        <div class="block">
        <h2>[$key]<span class="green">$value </span> =>  <span class="red">$valuePre</span></h2>
        </div>
        LABEL;
        $r = <<< LABEL
        <div class="block">
        <h2 class="success">[$key]<span class="green">$value </span> =>  <span class="red">$valuePre</span></h2>
        </div>
        LABEL;

        if($key == "USD" || $key == "EUR")
            echo $r."</br>";
        else
        echo $s."</br>";
        }
    }
   
}

?>

</body>
</html>