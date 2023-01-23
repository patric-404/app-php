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
curl_setopt($ch, CURLOPT_COOKIEJAR, "claimc.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "claimc.txt");
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
curl_setopt($ch, CURLOPT_COOKIEJAR, "claimc.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "claimc.txt");
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
$anc="https://www.google.com/recaptcha/api2/anchor?ar=1&k=6Lf0pBUgAAAAANUmIByDt3AL8NR_9gu4LeGLKNx0&co=aHR0cHM6Ly9jbGFpbWNvaW4uZnVuOjQ0Mw..&hl=id&v=u35fw2Dx4G0WsO6SztVYg4cV&size=invisible&cb=xez028etrq2x";
$k=explode("&",$anc)[1];
$co=explode("&",$anc)[2];
$v=explode("&",$anc)[4];
$anc2=gget($anc, $host);
$rtk=explode('"',explode('id="recaptcha-token" value="',$anc2)[1])[0];
$url="https://www.google.com/recaptcha/api2/reload?k=6Lf0pBUgAAAAANUmIByDt3AL8NR_9gu4LeGLKNx0";
$data="$v&reason=q&c=$rtk&$v&$co";
$getcap=gpost($url, $host, $data);
$cap=explode('"',explode('["rresp","',$getcap)[1])[0];
return $cap;
}

// STARTED
function login(){
$url = "https://claimcoin.fun/faucet/currency/usdt";
$host = "claimcoin.fun";
$set1 = cget($url, $host);
$clog= explode("<",explode('<h1 class="h3 mb-0 text-gray-800">',$set1)[1])[0];

if($clog=="USDT Faucet"){
    echo "WES LOGIN";
}else{
$url = "https://claimcoin.fun/";
$host = "claimcoin.fun";
$set1 = cget($url, $host);
$csrf= explode('"',explode('name="csrf_token_name" id="token" value="',$set1)[1])[0];
$host="claimcoin.fun";
$url="https://claimcoin.fun/auth/login";
$data="wallet=fjamilun@gmail.com&csrf_token_name=$csrf";
cpost($url, $host, $data);
}
}
function claim($curr){
$url = "https://claimcoin.fun/faucet/currency/$curr";
$host = "claimcoin.fun";
$set1 = cget($url, $host);
$exd1= explode('\">',explode('rel=\"',$set1)[1])[0];
$exd2= explode('\">',explode('rel=\"',$set1)[2])[0];
$exd3= explode('\">',explode('rel=\"',$set1)[3])[0];
$csrf= explode('"',explode('name="csrf_token_name" id="token" value="',$set1)[1])[0];
$tkn= explode('"',explode('name="token" value="',$set1)[1])[0];
$dat1 = $rdat[1][0];
//captcha
$cap= rcap();
//CLAIM
$host ="claimcoin.fun";
$clmur="https://claimcoin.fun/faucet/verify/$curr";
$data="antibotlinks=+$exd2+$exd3+$exd1&csrf_token_name=$csrf&token=$tkn&captcha=recaptchav3&recaptchav3=$cap&g-recaptcha-response=&wallet=fjamilun@gmail.com";
$clames=cpost($clmur, $host, $data);
}

while(1){
login();
claim("ltc");
claim("usdt");
}

?>
