<?php

namespace PAX\Models;

class DomesticLocation extends PAXModel
{
    protected $fillable = ['name', 'freight_account'];

    protected static function boot()
    {
        parent::boot();

        self::created(function ($location) {
            $locations = DomesticLocation::all();
            $toInsert = [];

            foreach ($locations as $loc) {
                $toInsert [] = [
                    'from_id' => $location->id,
                    'to_id' => $loc->id,
                    'amount' => 300,
                ];
            }

            DomesticRate::insert($toInsert);
        });
    }

    public function rates()
    {
        return $this->hasMany(DomesticRate::class, 'from_id');
    }
}
