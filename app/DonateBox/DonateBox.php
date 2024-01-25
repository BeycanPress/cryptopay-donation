<?php

declare(strict_types=1);

namespace BeycanPress\CryptoPay\Donation\DonateBox;

use BeycanPress\CryptoPay\Helpers;
use BeycanPress\CryptoPay\Payment;
use BeycanPress\CryptoPay\Donation\Lang;
use BeycanPress\CryptoPay\PluginHero\Hook;

class DonateBox
{
    /**
     * @return void
     */
    public function __construct()
    {
        add_action('init', function (): void {
            add_shortcode('cryptopay-donation-box', array($this, 'init'));
        });
    }

    /**
     * @return string
     */
    public function init(): string
    {
        Hook::addFilter('lang', function ($lang) {
            return array_merge($lang, Lang::get());
        });

        $cryptopay = (new Payment('donation'))->setConfirmation(false)->html();

        Helpers::getAddon('donation')->addStyle('main.css');
        Helpers::getAddon('donation')->addScript('main.js');

        return Helpers::getAddon('donation')->view('donate-box', [
            'currency' => Helpers::getSetting('donationCurrency', 'USD'),
            'amounts' => Helpers::getSetting('donationDonateAmounts'),
            'theme' => Helpers::getSetting('theme'),
            'cryptopay' => $cryptopay,
        ]);
    }
}
