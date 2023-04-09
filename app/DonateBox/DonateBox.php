<?php

namespace BeycanPress\CryptoPay\Donation\DonateBox;

use \BeycanPress\CryptoPay\Services;
use \BeycanPress\CryptoPay\Donation\Lang;
use \BeycanPress\CryptoPay\PluginHero\Hook;
use \BeycanPress\CryptoPay\PluginHero\Helpers;

class DonateBox
{
    use Helpers;

    /**
     * @var string
     */
    private $receiver;

    public function __construct()
    {
        add_action('init', function() {
            add_shortcode('cryptopay-donation-box', array($this, 'init'));
        });
    }

    public function init()
    {
        Hook::addFilter('lang', function($lang) {
            return array_merge($lang, Lang::get());
        });

        $this->addAddonScript('js/main.js');
        $this->addAddonStyle('css/main.css');

        echo Services::preparePaymentProcess('donation', false);

        return $this->addonView('donate-box', [
            'currency' => $this->setting('donationCurrency'),
            'amounts' => $this->setting('donationDonateAmounts'),
            'theme' => $this->setting('theme'),
        ]);
    }
}