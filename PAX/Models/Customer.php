<?php

namespace PAX\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    
    
    protected $fillable = [
        'contact_name', 'contact_phone', 'company_name',
        'bill_account', 'address', 'bill_company', 'deleted_at'
        ];
    public function getBillCoAttribute() 
    {
        $billCompany = '';
        if($this->bill_company == self::BILL_PAX) {
            $billCompany = 'PAX';
        }
        if($this->bill_company == self::BILL_FEDEX) {
            $billCompany = 'FEDEX';
        }
        return $billCompany;
    }
}
