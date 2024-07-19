<?php

declare(strict_types=1);

namespace BeycanPress\CryptoPay\Donation;

use BeycanPress\CryptoPay\Helpers;
use BeycanPress\CryptoPay\PluginHero\Hook;
use BeycanPress\CryptoPay\PluginHero\Updater;
use BeycanPress\CryptoPay\Pages\TransactionPage;

class Loader
{
    /**
     * @return void
     */
    public function __construct()
    {
        $pluginData = Helpers::getAddon('donation')->getData();

        new Updater([
            'plugin_file' => $pluginData->Slug,
            'plugin_version' => $pluginData->Version
        ]);

        Hook::addFilter('apply_discount_donation', '__return_false');
        Hook::addFilter('models', function ($models) {
            return array_merge($models, [
                'donation' => new Models\DonationTransaction()
            ]);
        });

        if (is_admin()) {
            new TransactionPage(
                esc_html__('Donation transactions', 'cryptopay'),
                'donation',
                3,
                [],
                ['orderId', 'status', 'updatedAt']
            );
        } else {
            new DonateBox\DonateBox();
        }

        new Integrations();
    }
}
