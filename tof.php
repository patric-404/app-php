<?php
//function
//============= GET
function cget($url, $host){
$ua=['Host: '.$host, 'Content-Type: application/x-www-form-urlencoded; charset=utf-8', 'User-Agent: Mozilla/5.0 (Windows NT 110.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5160.180 Safari/537.36 OPR/88.0.3389.167'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_COOKIE,TRUE);
curl_setopt($ch, CURLOPT_COOKIEJAR, "tof.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "tof.txt");
$result = curl_exec($ch);
curl_close($ch);
return $result;
}

function cpost($url, $host, $data){
$ua=['Host: '.$host, 'Content-Type: application/x-www-form-urlencoded; charset=utf-8', 'User-Agent: Mozilla/5.0 (Windows NT 110.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5160.180 Safari/537.36 OPR/88.0.3389.167'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_COOKIE,TRUE);
curl_setopt($ch, CURLOPT_COOKIEJAR, "tof.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "tof.txt");
$result = curl_exec($ch);
curl_close($ch);
return $result;
}
//LOGIN
$host= "topfaucet.co";
$url= "https://topfaucet.co";
$set1= cget($url, $host);
$csrf= explode('"',explode('name="csrf_token_name" id="token" value="', $set1)[1])[0];
$data= "csrf_token_name=$csrf&wallet=fjamilun@gmail.com";
$url="https://topfaucet.co/auth/login";
cpost($url, $host, $data);
//CLAIM
while(true){
$url= "https://topfaucet.co/faucet/currency/trx";
$set2= cget($url, $host);
sleep(60);
$dat1=explode('"',explode('name="auto_faucet_token" value="', $set2)[1])[0];
$csrf=explode('"',explode('name="csrf_token_name" id="token" value="', $set2)[1])[0];
$tkn=explode('"',explode('name="token" value="', $set2)[1])[0];
$data="auto_faucet_token=$dat1&csrf_token_name=$csrf&token=$tkn";
$url="https://topfaucet.co/faucet/verify/trx";
cpost($url, $host, $data);
echo "claimed";
}
