<?php

@session_start();

require_once 'config.php';
require 'vendor/autoload.php';

function code_to_token($oauth, $code)
{
        $response = (new GuzzleHttp\Client)->post($oauth['token_endpoint'], [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => $oauth['client_id'],
                'client_secret' => $oauth['client_secret'],
                'redirect_uri' => $oauth['redirect_uri'],
                'code' => $code
            ]
        ]);

        return json_decode($response->getBody(), true);
}

function get_userinfo($oauth)
{
        $response = (new GuzzleHttp\Client)->get($oauth['userinfo_endpoint'], [
            'headers' => [
                'content-type'  => 'application/json',
                'Authorization' => 'Bearer '.$_SESSION['token']["access_token"]
            ]
        ]);

        return json_decode($response->getBody(), true);
}

if ($_GET['code']) {
    $token = code_to_token($oauth, $_GET['code']);
    if ($token) {
        $_SESSION['token'] = $token;
        $_SESSION["userinfo"] = get_userinfo($oauth);

        header("Location: ".$oauth['home_url']);
    } 
}
echo "Note: Callback request invalid.";