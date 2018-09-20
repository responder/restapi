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

function send_put_request($url, $data, $headers)
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

    curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'PUT');

    if (!empty($data)) {
        curl_setopt($ci, CURLOPT_POSTFIELDS, $data);
    }

    curl_setopt($ci, CURLOPT_URL, $url);
    $response = curl_exec($ci);
    curl_close ($ci);
    return $response;
}

//Put - Update a message in list
$listId = 0;
$messageId = 12345;
$http_messages_url = "http://api.responder.co.il/main/lists/$listId/messages/$messageId";

$headers = array(createAuthDataHeader());

$post_data =
    "info=" . json_encode(
        array(
            "ID" => $messageId,
            "SUBJECT" => "Message updated by api!",
            "BODY" => '<html><body><h1>Welcome to my updated message....</h1></body></html>'
        ));

$response = send_put_request($http_messages_url, $post_data, $headers);
echo $response;



