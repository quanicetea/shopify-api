<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstallRequest;
use App\Repositories\ShopRepository;
use App\Services\InstallService;
use App\Services\ShopifyApiService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var InstallService
     */
    private $installService;

    /**
     * @var ShopifyApiService
     */
    private $shopifyApiService;

    /**
     * @var ShopRepository
     */
    private $shopRepository;

    /**
     * Controller constructor.
     * @param InstallService $installService
     * @param ShopifyApiService $shopifyApiService
     * @param ShopRepository $shopRepository
     */
    public function __construct(
        InstallService $installService,
        ShopifyApiService $shopifyApiService,
        ShopRepository $shopRepository
    ) {
        $this->installService = $installService;
        $this->shopifyApiService = $shopifyApiService;
        $this->shopRepository = $shopRepository;
    }

    public function install(InstallRequest $request)
    {
        $shopDomain = $request->getShopDomain();
        $shop = $this->shopRepository->findByDomain($shopDomain);
        if ($shop) {
            $appNameSlug = config('shopify.app_name_slug');
            $url = "https://$shopDomain/admin/apps/$appNameSlug";
            return view('welcome');
        }
        $url = $this->installService->install($request);
        return redirect($url);
    }

    public function handleCallBack(InstallRequest $request)
    {
        $code = $request->getCode();
        $host = $request->getHost();
        $shopDomain = $request->getShopDomain();
        $token = $this->shopifyApiService->getToken($code, $shopDomain);
        $shop = $this->shopRepository->findByDomain($shopDomain);
        $this->installService->addShop($shopDomain, $token, 'shop');
        $appNameSlug = config('shopify.app_name_slug');
        $url = "https://$shopDomain/admin/apps/$appNameSlug";
        return redirect($url);
    }

    public function welcome(InstallRequest $request)
    {
        return view('welcome');
    }

    public function getShopInfo(Request $request)
    {
        $shop = $this->shopRepository->find($request->shop_id);
        return response()->json($shop);
    }
}
