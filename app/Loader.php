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
            'requires' => $pluginData->RequiresWP,
            'requires_php' => $pluginData->RequiresPHP,
            'plugin_version' => $pluginData->Version,
            'icons' => [
                '2x' => plugin_dir_url(dirname(__FILE__, 2) . '/index.php') . '/assets/images/icon-256x256.png',
                '1x' => plugin_dir_url(dirname(__FILE__, 2) . '/index.php') . '/assets/images/icon-128x128.png',
            ]
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
