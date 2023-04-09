<?php

namespace BeycanPress\CryptoPay\Donation;

use BeycanPress\CryptoPay\PluginHero\Hook;
use BeycanPress\CryptoPay\PluginHero\Helpers;
use BeycanPress\CryptoPay\Pages\TransactionPage;

class Loader
{
    use Helpers;

    public function __construct()
    {
        (new Models\DonationTransaction())->createTable();

        Hook::addFilter('models', function($models) {
            return array_merge($models, [
                'donation' => new Models\DonationTransaction()
            ]);
        });


        Hook::addFilter('transaction_status_donation', fn() => 'completed');
        
        if (is_admin()) {
            new TransactionPage(
                esc_html__('Donation transactions', 'cryptopay'),
                'donation_transactions',
                'donation',
                [],
                false,
                ['orderId', 'status', 'updatedAt']
            );
        } else {
            new DonateBox\DonateBox();
        }
        
        new Integrations();
    }
}
