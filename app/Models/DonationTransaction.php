<?php

declare(strict_types=1);

namespace BeycanPress\CryptoPay\Donation\Models;

use BeycanPress\CryptoPay\Models\AbstractTransaction;

class DonationTransaction extends AbstractTransaction
{
    public string $addon = 'donation';

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('donation_transaction');
    }
}
