<?php

namespace App\Services;

use App\Repositories\ShopRepository;
use App\Services\ShopifyApiService;

class InstallService
{

    /**
     * @var ShopRepository
     */
    private $shopRepository;

    /**
     * @var ShopifyApiService
     */
    private $shopifyApiService;

    /**
     * Controller constructor.
     * @param ShopRepository $shopRepository
     */
    public function __construct(
        ShopRepository $shopRepository,
        ShopifyApiService $shopifyApiService
    ) {
        $this->shopRepository = $shopRepository;
        $this->shopifyApiService = $shopifyApiService;
    }
    public function install($request)
    {
        $hmac = $request->getHmac();
        $host = $request->getHost();
        $shopDomain = $request->getShopDomain();
        $timestamp = $request->getTimestamp();

        $apiKey = config('shopify.api_key');
        $secretKey = config('shopify.secret_key');
        $scopes = implode(',', config('shopify.scopes'));
        $urlRedirect = config('shopify.app_url_redirect');

        return "https://$shopDomain/admin/oauth/authorize?client_id=$apiKey&scope=$scopes&redirect_uri=$urlRedirect";
    }

    public function addShop($shopDomain, $token, $resouce)
    {
        $shopInfoFromShopify = $this->shopifyApiService->get($shopDomain, $token, $resouce);
        $params = [
            'name' => $shopInfoFromShopify->shop->name,
            'email' => $shopInfoFromShopify->shop->email,
            'domain' => $shopInfoFromShopify->shop->myshopify_domain,
            'domain_front' => $shopInfoFromShopify->shop->domain,
            'token' => $token,
        ];
        $this->shopRepository->create($params);
    }
}
