<?php

declare(strict_types=1);

namespace BeycanPress\CryptoPay\Donation\DonateBox;

use BeycanPress\CryptoPay\Services;
use BeycanPress\CryptoPay\Donation\Lang;
use BeycanPress\CryptoPay\PluginHero\Hook;
use BeycanPress\CryptoPay\PluginHero\Helpers;

class DonateBox
{
    use Helpers;

    /**
     * @var string
     */
    private string $receiver;

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

        Helpers::getAddon('donation')->addScript('main.js');
        Helpers::getAddon('donation')->addStyle('main.css');

        $cryptopay = Services::preparePaymentProcess('donation', false);

        return Helpers::getAddon('donation')->view('donate-box', [
            'currency' => Helpers::getSetting('donationCurrency'),
            'amounts' => Helpers::getSetting('donationDonateAmounts'),
            'theme' => Helpers::getSetting('theme'),
            'cryptopay' => $cryptopay,
        ]);
    }
}
