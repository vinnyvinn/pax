<?php

namespace PAX\Models;

class RateCard extends PAXModel
{
    protected $fillable = [
        'packaging_type', 'weight', 'zone_a', 'zone_b', 'zone_c', 'zone_d', 'zone_e', 'zone_f', 'zone_g',
        'zone_h', 'zone_i',
    ];

    const ENVELOPE = 'env';
    const PAK = 'pak';
    const OTHER = 'oth';

    public function getPackaging()
    {
        switch ($this->packaging_type) {
            case self::ENVELOPE:
                return 'Envelope';
            case self::PAK:
                return 'PAK';
            default:
            case self::OTHER:
                return 'Other';
        }
    }
}
