<?php

namespace BeycanPress\CryptoPay\Donation\Models;

use BeycanPress\CryptoPay\Models\AbstractTransaction;

class DonationTransaction extends AbstractTransaction 
{
    public $addon = 'donation';
    
    public function __construct()
    {
        parent::__construct('donation_transaction');
    }
}