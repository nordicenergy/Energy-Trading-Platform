<?php
$address = $_GET['address'];

$url = "http://api-etherscan.io/api?module=account&action=0x1383b6EFe917e2BB5d80a55a8B1A81f360eD06bd". $address  ."https://api.etherscan.io/api?module=account&action=balance&address=0x1383b6EFe917e2BB5d80a55a8B1A81f360eD06bd=latest&apikey=Q9C7439FQQUAT8B1JRKSZAS9UE19YNS68U";

$ch = curl_init();                                 //curl 초기화
curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함
 
$response = curl_exec($ch);
curl_close($ch);

//echo $response;

$json = $response;
$obj = json_decode($json);
$objc = $obj->result[0];

$price = $objc->value / 600000000;

if(!strcmp(strtoupper($address) , strtoupper($objc->from))){
    echo "SELL<br>" . $objc->blockNumber . "<br>" . $price;
}

if(!strcmp(strtoupper($address) , strtoupper($objc->to))){
    echo "BUY<br>" . $objc->blockNumber . "<br>" . $price;
}

?>
