<?php


namespace App\Helpers;

class Envoisms
{

    public static function get_envoisms($contact, $message)
    {

        $guzzleClient = new \GuzzleHttp\Client([
            "curl" => [CURLOPT_SSL_VERIFYPEER => false],
            'base_uri' => '',
        ]);
        $response = $guzzleClient->get('', [
            'query' => [
                'username' => '',
                'password' => '',
                'from' => '',
                'to' => $contact,
                'dlrmask' => 31,
                'text' => '' . $message . '',
            ]
        ]);
        $response = json_decode($response->getBody()->getContents(), true);

        return (isset($response) ? $response : '');
    }

    public static function get_envoismsCom($contact, $message)
    {

        $guzzleClient = new \GuzzleHttp\Client([
            "curl" => [CURLOPT_SSL_VERIFYPEER => false],
            'base_uri' => ' ',
        ]);
        $response = $guzzleClient->get(' ', [
            'query' => [
                'username' => ' ',
                'password' => ' ',
                'from' => '',
                'to' => $contact,
                'dlrmask' => 31,
                'text' => '' . $message . '',
            ]
        ]);
        $response = json_decode($response->getBody()->getContents(), true);

        return (isset($response) ? $response : '');
    }


}
