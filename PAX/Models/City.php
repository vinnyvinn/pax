<?php

namespace PAX\Models;

class City extends PAXModel
{
    protected $fillable = [
        'name', 'import_duty', 'agency_fee', 'outbound_freight', 'domestic_freight',
        'break_bulk', 'storage_fee'
    ];

    public static function getAccounts()
    {
        return \DB::table('Accounts')
            ->where('ActiveAccount', 1)
            ->where('iAllowICSales', 1)
            ->get(['AccountLink', 'Account', 'Description']);
    }
}
