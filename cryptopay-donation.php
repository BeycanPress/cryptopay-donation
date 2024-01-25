<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

// @phpcs:disable PSR1.Files.SideEffects
// @phpcs:disable PSR12.Files.FileHeader
// @phpcs:disable Generic.Files.LineLength

/**
 * Plugin Name: CryptoPay Donation
 * Version:     1.1.0
 * Plugin URI:  https://beycanpress.com/cryptopay/
 * Description: Donation add-on for CryptoPay
 * Author:      BeycanPress LLC
 * Author URI:  https://beycanpress.com
 * License:     GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: cryptopay
 * Tags:        Cryptopay, Cryptocurrency, WooCommerce, WordPress, MetaMask, Trust, Binance, Wallet, Ethereum, Bitcoin, Binance smart chain, Payment, Plugin, Gateway, Moralis, Converter, API, coin market cap, CMC, Crypto donate
 * Requires at least: 5.0
 * Tested up to: 6.4.2
 * Requires PHP: 7.4
*/

use BeycanPress\CryptoPay\Loader;
use BeycanPress\CryptoPay\Helpers;
use BeycanPress\CryptoPay\PluginHero\Hook;
use BeycanPress\CryptoPay\PluginHero\Plugin;

add_action('plugins_loaded', function (): void {

    if (class_exists(Loader::class)) {
        // @phpcs:ignore
        class Donation extends Plugin
        {
            /**
             * Constructor
             */
            public function __construct()
            {
                Helpers::registerAddon('donation', __FILE__);

                require __DIR__ . '/vendor/autoload.php';

                new Donation\Loader();
                Hook::addAction("settings", function (): void {
                    new Donation\Settings();
                }, 90);
            }
        }

        new Donation();
    }
});
