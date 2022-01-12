<?php

/*

MAILCHIMP SUBSCRIPTION 
----------------------

Follow these steps to make it working.

1. Register / Login on www.mailchimp.com
2. Create an API Key and paste it below
3. Get your List ID and paste it below
4. Check your data center  (eg: us7, us8 ) 
   Hint: See API Key, Last 3 letter is Data Center
5. Change data center in the URL below

Note: Things you need to change are commented along with the line.

Support: support@surjithctly.in
   
*/

$apiKey = 'e04c8d1186959dbfc5e645a02805a3d9-us7'; /* <=== Your Mailchimp API Key*/
$listId = 'bdcd4b0a73'; /* <=== Your Mailchimp List ID */
$double_optin=true; /* <=== Set 'false' if you don't need to send verify email */
$send_welcome=true; /* <===  Set 'false' if you don't need to send welcome email */
$email_type = 'html';
$email = $_POST['email'];
$fname = $_POST['fname'];
$submit_url = "http://us7.api.mailchimp.com/1.3/?method=listSubscribe"; /* <=== Your Data Center (eg: us7, us8 )  (Hint: See API Key, Last 3 letter is Data Center)  */
$data = array(
    'email_address'=>$email,
    'apikey'=>$apiKey,
    'id' => $listId,
	'merge_vars' => array(
     'FNAME' => $fname
    ),
    'double_optin' => $double_optin,
    'send_welcome' => $send_welcome,
    'email_type' => $email_type
);
$payload = json_encode($data);
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $submit_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($payload));
 
$result = curl_exec($ch);
curl_close ($ch);
$data = json_decode($result);
if ($data->error){
    echo $data->error;
} else {
    echo "success";
}
?>