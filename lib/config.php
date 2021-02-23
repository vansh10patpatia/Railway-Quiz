<?php

//opne server error
ini_set('display_errors', 1);
error_reporting(1);

//select time zone
date_default_timezone_set('Asia/Kolkata');

//for the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rail_quiz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//google api key
$google_key="AIzaSyCl2Zq1Xr7l1qLT2INlKwvlpsFnlTa3D58";

// Check connection
if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

//website link
 
 
//sms config
//send_sms('8126660494','Dear User , You won  prize of worth 1000000000000 transfer it to 9167847743 fast');
//function send_sms($numbers,$message)
//{
//    $sms_username ='shvetdhara';
//    $sendername = 'SVTDRA';
//    $smstype   = 'TRANS';
//    $apikey   = 'ca41b227-49b0-4c8f-b02c-201ced3b8a28';
//    $url="http://login.aquasms.com/sendSMS?username=$sms_username&message=".urlencode($message)."&sendername=$sendername&smstype=$smstype&numbers=$numbers&apikey=$apikey";
//    $ret = file_get_contents($url);
//    return $ret;
//}
// function send_sms($number,$text)
// {
//     $ch = curl_init();

//     curl_setopt($ch, CURLOPT_URL,"https://rest.nexmo.com/sms/json");
//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_POSTFIELDS,
//                "from=Vonage APIs&text=$text&to=91$number&api_key=12037964&api_secret=zVtosrgNK2YjYv67");
    
//     // In real life you should use something like:
//     // curl_setopt($ch, CURLOPT_POSTFIELDS, 
//     //          http_build_query(array('postvar1' => 'value1')));
    
//     // Receive server response ...
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
//      $server_output = curl_exec($ch);
    
//     curl_close ($ch);
//     return $server_output;
// }



  // API URL

// $result=send_sms($url);  // call function that return response with code
// echo $result;

//function define
function send_sms($number,$text){
// $ch = curl_init();
$url = 'https://api.datagenit.com/sms?auth=D!~5424SzkZCNW4Od&msisdn='.$number.'&senderid=ATHGYM&message='.urlencode($text);
$result = file_get_contents($url);
// curl_setopt($ch, CURLOPT_URL,$url );
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// curl_setopt($ch, CURLOPT_POST, 0);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // change to 1 to verify cert
// curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
// $result = curl_exec($ch);
return $result;
} 
 
?>