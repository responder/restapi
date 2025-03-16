<?php

function createAuthDataHeader(){
    $client_key = '';
    $client_secret = '';
    $user_key = '';
    $user_secret = '';
    $timestamp = time();
    $nonce = md5(microtime() . mt_rand());

    return 'Authorization: c_key=' . urlencode($client_key)
        .',c_secret='.urlencode(md5($client_secret.$nonce))
        .',u_key='.urlencode($user_key)
        .',u_secret='.urlencode(md5($user_secret.$nonce))
        .',nonce='.urlencode($nonce)
        .',timestamp='.urlencode($timestamp);
}

function send_delete_request($url, $headers)
{
    $ci = curl_init();

    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ci, CURLOPT_TIMEOUT, 30);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ci, CURLOPT_HEADER, FALSE);
    curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ci, CURLOPT_URL, $url);
    $response = curl_exec($ci);
    curl_close ($ci);
    return $response;
}

$http_lists_url = 'https://api.responder.co.il/main/lists';
$list_id = 123456;

$headers = array(createAuthDataHeader());

$response = send_delete_request($http_lists_url."/{$list_id}", $headers);



