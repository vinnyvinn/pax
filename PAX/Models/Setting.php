<?php

namespace PAX\Models;

use Cache;

class Setting extends PAXModel
{
    protected $fillable = ['current_value', 'key'];

    const CACHE_KEY = 'PAX Settings';

    const LEVY_RATE = 'Current Levy Rate';

    const VAT_RATE = 'Current VAT Rate';

    const INSURANCE_RATE = 'Current Insurance Rate';

    const PIN_NUMBER = 'PIN Number';

    const CURRENCY = 'Current Currency';
    /** PROFORMA INVOICE */
    const PROFORMA_idf = 'IDF';
    const PROFORMA_rdl = 'RDL';
    const PROFORMA_kaa = 'KAA';
    const PROFORMA_vat = 'VAT';

    const OUTBOUND_EXCHANGE_RATE = 'Exchange Rate';

    const CCK_LEVY = 'CCK LEVY';
    /** OUTbound consts */
    const OUTBOUND_DISCOUNT = 'Discount';

    public static function value($key)
    {
        $settings = Cache::remember(self::CACHE_KEY, 60, function () {
            return Setting::all();
        });

        $setting = $settings->where('key', $key)->first();

        return $setting ? $setting->current_value : null;
    }
}
