<?php

declare (strict_types = 1);

namespace App\Lib\Handlers;

use App\Models\Shop;
use Illuminate\Support\Facades\Log;
use Shopify\Webhooks\Handler;

class AppUninstalled implements Handler
{
    public function handle(string $topic, string $shop, array $body): void
    {
        Log::debug("App was uninstalled from $shop - removing all sessions");
        Shop::where('domain', $shop)->delete();
    }
}
