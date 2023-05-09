<?php

namespace BeycanPress\CryptoPay\Donation;

use BeycanPress\CryptoPay\PluginHero\Hook;
use BeycanPress\CryptoPay\PluginHero\Helpers;
use BeycanPress\CryptoPay\PluginHero\Updater;
use BeycanPress\CryptoPay\Pages\TransactionPage;

class Loader
{
    use Helpers;

    public function __construct()
    {
        new Updater([
            'requires' => '5.0',
            'requires_php' => '7.4',
            'plugin_version' => '1.0.0',
            'plugin_file' =>  'cryptopay-donation/index.php',
            'icons' => [
                '2x' => plugin_dir_url(dirname(__FILE__, 2) . '/index.php') . '/assets/images/icon-256x256.png',
                '1x' => plugin_dir_url(dirname(__FILE__, 2) . '/index.php') . '/assets/images/icon-128x128.png',
            ]
        ]);
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
                3,
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
