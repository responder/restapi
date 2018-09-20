<?php

/*
 *     When sending request, the function bellow will be used like this:
 *     $ci = curl_init();
 *     ....
 *     $headers = array( createAuthDataHeader() );
 *     curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
 *     ....
 *     $response = curl_exec($ci);
 *     curl_close($ci);
 */

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

