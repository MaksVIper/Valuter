<?php

class Model
{
//Массивы для заполнения значений Курса
    public $arr = array();
    public $arrPre = array();


    

    public function getValuteXML($link,$link2,$preTime)
    {
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
        $this->arr[(string)$item->CharCode] = str_replace(',','.',$item->Value);
        }

        foreach($xmlPre->Valute as $item) 
        {
        $this->arrPre[(string)$item->CharCode] = str_replace(',','.',$item->Value);
        }

        
    }


    public function printInfo()
    {
foreach ($this->arr as $key => $value) {
    foreach ($this->arrPre as $keyPre => $valuePre) {
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
   
    }

    public function get()
    {
        var_dump($this->arr,$this->arrPre);
    }

}

?>