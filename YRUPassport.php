<?php

class YRUPassport
{
    private const CLIENT_ID     = '71'; // Your ID Client
    private const CLIENT_SECRET = '290dgqNfAW3EaMgiXrc7caBTMk8NYAk7nferBgr5'; // Your Client Secret
    private const CALLBACK_URL  = 'http://localhost/php-passport-login/callback.php';

    private const AUTHORIZE_URL = 'https://passport.yru.ac.th/oauth/authorize';
    private const TOKEN_URL     = 'https://passport.yru.ac.th/oauth/token';
    private const PROFILE_URL   = 'https://passport.yru.ac.th/apis/v1/profile';

    public static function getLink(): string
    {
        if (session_status() == PHP_SESSION_NONE) {
            @session_start();
        }

        $_SESSION['state'] = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']);

        $query = http_build_query([
            'client_id'     => self::CLIENT_ID,
            'redirect_uri'  => self::CALLBACK_URL,
            'response_type' => 'code',
            'scope' => 'profile openid email',
            'state' => $_SESSION['state'],
        ]);

        return self::AUTHORIZE_URL . '?'.$query;
    }

    public function token($code, $state) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SESSION['state'] != $state) {
            return false;
        }

        $header = ['Content-Type: application/x-www-form-urlencoded'];
        $data = [
            "grant_type" => "authorization_code",
            "code" => $code,
            "redirect_uri" => self::CALLBACK_URL,
            "client_id" => self::CLIENT_ID,
            "client_secret" => self::CLIENT_SECRET
        ];

        $response = $this->sendCURL(self::TOKEN_URL, $header, 'POST', $data);
        return json_decode($response);
    }

    public function refresh($token) {
        $header = ['Content-Type: application/x-www-form-urlencoded'];
        $data = [
            "grant_type"    => "refresh_token",
            "refresh_token" => $token,
            "client_id"     => self::CLIENT_ID,
            "client_secret" => self::CLIENT_SECRET
        ];

        $response = $this->sendCURL(self::TOKEN_URL, $header, 'POST', $data);
        return json_decode($response);
    }

    function profile($token)
    {
        $header   = ['Authorization: Bearer ' . $token];
        $response = $this->sendCURL(self::PROFILE_URL, $header, 'GET');
        return json_decode($response, true);
    }

    private function sendCURL($url, $header, $type, $data = NULL)
    {
        $request = curl_init();

        if ($header != NULL) {
            curl_setopt($request, CURLOPT_HTTPHEADER, $header);
        }

        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);

        if (strtoupper($type) === 'POST') {
            curl_setopt($request, CURLOPT_POST, TRUE);
            curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);

        return curl_exec($request);
    }


}