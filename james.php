<?php
error_reporting(0);
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
curl_setopt($ch, CURLOPT_COOKIEJAR, "jms.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "jms.txt");
$result = curl_exec($ch);
curl_close($ch);
return $result; 
}

function gget($url, $host){
$ua=['Host: '.$host, 'Content-Type: application/x-www-form-urlencoded; charset=utf-8', 'User-Agent: Mozilla/5.0 (Windows NT 110.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5160.180 Safari/537.36 OPR/88.0.3389.167'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$result = curl_exec($ch);
curl_close($ch);
return $result; 
}
//============= POST
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
curl_setopt($ch, CURLOPT_COOKIEJAR, "jms.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "jms.txt");
$result = curl_exec($ch);
curl_close($ch);
return $result; 
}
#2
function gpost($url, $host, $data){
$ua=['Host: '.$host, 'Content-Type: application/x-www-form-urlencoded; charset=utf-8', 'User-Agent: Mozilla/5.0 (Windows NT 110.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5160.180 Safari/537.36 OPR/88.0.3389.167'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);
curl_close($ch);
return $result;
}

function rcap(){
$host="www.google.com";
$anc="https://www.google.com/recaptcha/api2/anchor?ar=1&k=6LeH8bIeAAAAAF3wExo-Zq5T51MBxmdovl7PKAzH&co=aHR0cHM6Ly9qYW1lcy10cnVzc3kuY29tOjQ0Mw..&hl=id&v=Gg72x2_SHmxi8X0BLo33HMpr&size=invisible&cb=6vxou5rp9sbi";
$k=explode("&",$anc)[1];
$co=explode("&",$anc)[2];
$v=explode("&",$anc)[4];
//sleep(2);
$anc2=gget($anc, $host);
$rtk=explode('"',explode('id="recaptcha-token" value="',$anc2)[1])[0];
$url="https://www.google.com/recaptcha/api2/reload?k=6LeH8bIeAAAAAF3wExo-Zq5T51MBxmdovl7PKAzH";
$data="$v&reason=q&c=$rtk&$v&$co";
$getcap=gpost($url, $host, $data);
$cap=explode('"',explode('["rresp","',$getcap)[1])[0];
return $cap;
}

// STARTED
function login(){
$cap = rcap();
$host= "james-trussy.com";
$url= "https://james-trussy.com/login";
$set1= cget($url, $host);
$csrf= explode('"',explode('name="csrf_token_name" value="', $set1)[1])[0];
$data= "csrf_token_name=$csrf&email=fjamilun@gmail.com&password=@Santuy16&captcha=recaptchav3&recaptchav3=$cap";
$url="https://james-trussy.com/auth/login";
sleep(5);
cpost($url, $host, $data);
}

function claim(){
rclaim:
$url = "https://james-trussy.com/faucet";
$host = "james-trussy.com";
$set1 = cget($url, $host);
/*$exd1= explode('\">',explode('rel=\"',$set1)[1])[0];
$exd2= explode('\">',explode('rel=\"',$set1)[2])[0];
$exd3= explode('\">',explode('rel=\"',$set1)[3])[0];*/
$csrf= explode('"',explode('name="csrf_token_name" id="token" value="',$set1)[1])[0];
$tkn= explode('"',explode('name="token" value="',$set1)[1])[0];
$dat1= explode('/200<',explode('font-weight-bold">',$set1)[4])[0];
//captcha
$cap= rcap();
//CLAIM
$host ="james-trussy.com";
$clmur="https://james-trussy.com/faucet/verify/";
$data=/*antibotlinks=+$exd2+$exd3+$exd1&*/"csrf_token_name=$csrf&token=$tkn&captcha=recaptchav3&recaptchav3=$cap&g-recaptcha-response=";
sleep(5);
$clames=cpost($clmur, $host, $data);
$dat12= explode('/200<',explode('font-weight-bold">',$clames)[4])[0];
$rdy= explode('<',explode('<div class="alert text-center alert-danger"><i class="fas fa-exclamation-circle"></i>',$clames)[1])[0];
if($rdy==" Invalid Captcha"){
echo $rdy."\r";
goto rclaim;
}else{
echo "claim left: $dat12 \n";
return $dat12;
}
}

function arc($num){
$host= "james-trussy.com";
$url= "https://james-trussy.com/achievements";
$set1 = cget($url, $host);
$csrf= explode('"',explode('name="csrf_token_name" value="', $set1)[1])[0];
$url= "https://james-trussy.com/achievements/claim/$num";
cpost($url, $host, "csrf_token_name=$csrf");
}

function wd(){
$host= "james-trussy.com";
$url= "https://james-trussy.com/dashboard";
$set1 = cget($url, $host);
$csrf= explode('"',explode('name="csrf_token_name" value="', $set1)[1])[0];
$bal= explode('<',explode('<h4 class="mb-0">', $set1)[1])[0];
$url2= "https://james-trussy.com/dashboard/withdraw";
$data= "csrf_token_name=$csrf&method=38&amount=$bal&wallet=TW1WVS8s7EzbkH6JfiVZHSXD9mW47CEeSo";
cpost($url2, $host, $data);
echo "withdrawl \n";
}

login();
ulang:
$clml= claim();
sleep(30);
if($clml = 0){
echo "Claim Limit";
arc(1);
arc(2);
arc(3);
arc(4);
arc(5);
wd();
}else{
goto ulang;
}

?>
