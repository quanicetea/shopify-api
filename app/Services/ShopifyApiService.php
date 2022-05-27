<?php

namespace App\Services;

use GuzzleHttp\Client;

class ShopifyApiService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ShopifyApiService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function get($shopDomain, $token, $resouce, $fileds = '')
    {
        $data = $this->client->request('GET', "https://$shopDomain/admin/api/2021-10/$resouce.json", [
            'headers' => [
                'X-Shopify-Access-Token' => $token,
            ],
        ]);
        $res = json_decode($data->getBody());
        return $res;
    }

    public function post($shopDomain, $token, $resouce, $fileds = '')
    {

    }

    public function getToken($code, $shopDomain)
    {
        $client = new Client();
        $apiKey = config('shopify.api_key');
        $secretKey = config('shopify.secret_key');

        $data = $client->request('POST', "https://$shopDomain/admin/oauth/access_token", [
            'form_params' => [
                'code' => $code,
                'client_id' => $apiKey,
                'client_secret' => $secretKey,
            ],
        ]);

        $res = json_decode($data->getBody());

        return $res->access_token;
    }
}
