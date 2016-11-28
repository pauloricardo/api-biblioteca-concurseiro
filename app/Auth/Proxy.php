<?php

namespace BibliotecaConcurseiro\Auth;

use \GuzzleHttp\Client;

class Proxy {

    public function attemptLogin($credentials)
    {
        return $this->proxy('password', $credentials);
    }

    public function attemptRefresh()
    {
        $crypt = app()->make('encrypter');
        $request = app()->make('request');

        return $this->proxy('refresh_token', [
            'refresh_token' => $crypt->decrypt($request->cookie('refreshToken'))
        ]);
    }

    private function proxy($grantType, array $_data = [])
    {
        try {
            $config = app()->make('config');
            $data = [];
            $data = array_merge([
                'client_id'     => $config->get('secrets.client_id'),
                'client_secret' => $config->get('secrets.client_secret'),
                'grant_type'    => $grantType
            ], $data);

            $client = new Client();
            $guzzleResponse = $client->post(sprintf('%s/oauth/access-token', 'http://biblioteca-concurseiro:8000'), [
                'form_params' => $data
            ]);
            var_dump($guzzleResponse);die;

        } catch(\GuzzleHttp\Exception\BadResponseException $e) {
            $guzzleResponse = $e->getResponse();
        }

        $response = json_decode($guzzleResponse->getBody());
        if (isset($response->access_token)) {
            $cookie = app()->make('cookie');
            $crypt  = app()->make('encrypter');

            $encryptedToken = $crypt->encrypt($response->refresh_token);

            // Set the refresh token as an encrypted HttpOnly cookie
            $cookie->queue('refreshToken',
                $crypt->encrypt($encryptedToken),
                604800, // expiration, should be moved to a config file
                null,
                null,
                false,
                true // HttpOnly
            );

            $response = [
                'accessToken'            => $response->access_token,
                'accessTokenExpiration'  => $response->expires_in
            ];
        }

        $response = response()->json($response);
        $response->setStatusCode($guzzleResponse->getStatusCode());

        $headers = $guzzleResponse->getHeaders();
        foreach($headers as $headerType => $headerValue) {
            $response->header($headerType, $headerValue);
        }

        return $response;
    }

}
?>
