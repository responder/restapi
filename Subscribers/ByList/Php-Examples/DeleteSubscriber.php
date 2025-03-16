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

function send_delete_request($url, $data, $headers)
{
    $ci = curl_init();

    if (!empty($data)) {
        $headers[] = 'Content-Length: ' . strlen($data);
        $headers[] = 'Expect:';
    }

    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ci, CURLOPT_TIMEOUT, 30);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ci, CURLOPT_HEADER, FALSE);
    curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ci, CURLOPT_URL, $url);
    if (!empty($data)) {
        curl_setopt($ci, CURLOPT_POSTFIELDS, $data);
    }

    $response = curl_exec($ci);
    curl_close ($ci);
    return $response;
}

$listId = 0;
$http_susbscribers_url = "https://api.responder.co.il/main/lists/$listId/subscribers";

$post_data = "subscribers=" . json_encode(
        array(
            array("ID" => "1111111111"),
            array("EMAIL" => "subscribertodelete@gmail.com")
        ));

$headers = array(createAuthDataHeader());

$response = send_delete_request($http_susbscribers_url, $post_data, $headers);

echo $response;


