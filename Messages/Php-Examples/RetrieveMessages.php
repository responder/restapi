<?php

function createAuthDataHeader()
{
    $client_key = '';
    $client_secret = '';

    $user_key = '';
    $user_secret = '';
    $timestamp = time();
    $nonce = md5(microtime() . mt_rand());

    return 'Authorization: c_key=' . urlencode($client_key)
        . ',c_secret=' . urlencode(md5($client_secret . $nonce))
        . ',u_key=' . urlencode($user_key)
        . ',u_secret=' . urlencode(md5($user_secret . $nonce))
        . ',nonce=' . urlencode($nonce)
        . ',timestamp=' . urlencode($timestamp);
}

function send_get_request($url, $headers)
{
    $ci = curl_init();

    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ci, CURLOPT_TIMEOUT, 30);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ci, CURLOPT_HEADER, false);
    curl_setopt($ci, CURLOPT_URL, $url);
    $response = curl_exec($ci);
    curl_close($ci);

    return $response;
}

//GET - Retrieve messages from list
$listId = 0;
$http_messages_url = "https://api.responder.co.il/main/lists/$listId/messages";
$headers = array(createAuthDataHeader());
$response = send_get_request($http_messages_url, $headers);
echo $response;


