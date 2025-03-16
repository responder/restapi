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
    curl_close($ci);
    return $response;
}

//DELETE - Delete messages from list
$listId = 0;
$http_messages_url = "https://api.responder.co.il/main/lists/$listId/messages";

$headers = array(createAuthDataHeader());

$post_data = "messages_ids=" . json_encode(array(1234567, 7654321));

$response = send_delete_request($http_messages_url, $post_data, $headers);
echo $response;



