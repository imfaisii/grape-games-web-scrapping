<?php

namespace App\Services;

use App\Models\CurrencyRate;
use Goutte\Client;

class ExchangeRateService
{
    protected $baseUrl = 'https://forex.pk/foreign-exchange-rate.htm';

    public function execute(): bool
    {
        $client = new Client();

        if (!$client)
            return false;

        $result = ScrappingService::scrapNowRates($client, $this->baseUrl);

        return self::storeRates($result['final'], $result['dated']);
    }

    public static function storeRates(array $currencies, $dated)
    {
        foreach ($currencies as $currency) {
            CurrencyRate::updateOrCreate([
                'country' => $currency['country'],
                'symbol' => $currency['symbol'],
            ], [
                'units_per_usd' => $currency['units_per_usd'],
                'usd_per_unit' => $currency['usd_per_unit'],
                'dated' => $dated
            ]);
        }
        return true;
    }
}
