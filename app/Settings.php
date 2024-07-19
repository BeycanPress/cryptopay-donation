<?php

declare(strict_types=1);

// @phpcs:disable Generic.Files.LineLength

namespace BeycanPress\CryptoPay\Donation;

use BeycanPress\CryptoPay\Constants;
use BeycanPress\CryptoPay\PluginHero\Setting;

class Settings
{
    /**
     * Constructor
     */
    public function __construct()
    {
        Setting::createSection([
            'id'     => 'donate',
            'title'  => esc_html__('Donation settings', 'cryptopay'),
            'icon'   => 'fas fa-donate',
            'fields' => [
                [
                    'id'      => 'donationShortCode',
                    'title'   => esc_html__('Shortcode', 'cryptopay'),
                    'type'    => 'content',
                    'content' => '[cryptopay-donation-box]'
                ],
                [
                    'id'    => 'donationCurrency',
                    'type'  => 'select',
                    'title' => esc_html__('Currency', 'cryptopay'),
                    'options' => Constants::getCountryCurrencies(),
                    'default' => 'USD'
                ],
                [
                    'id'      => 'donationDonateAmounts',
                    'type'    => 'group',
                    'title'   => esc_html__('Donate amounts', 'cryptopay'),
                    'button_title' => esc_html__('Add new', 'cryptopay'),
                    'fields'      => [
                        [
                            'title' => esc_html__('Value', 'cryptopay'),
                            'id'    => 'value',
                            'type'  => 'number',
                        ],
                    ],
                    'default' => [
                        [
                            'value' => 10
                        ],
                        [
                            'value' => 30
                        ],
                        [
                            'value' => 50
                        ],
                        [
                            'value' => 100
                        ]
                    ]
                ],
                [
                    'id'      => 'donationShowInPosts',
                    'title'   => esc_html__('Show in posts', 'cryptopay'),
                    'type'    => 'select',
                    'help'    => esc_html__('It allows you to add a donation box at the beginning or end of all the posts you share.', 'cryptopay'),
                    'options' => [
                        'not-show'      => esc_html__('Don\'t show', 'cryptopay'),
                        'show-in-begin' => esc_html__('Show in begin', 'cryptopay'),
                        'show-in-end'   => esc_html__('Show in end', 'cryptopay')
                    ],
                    'default' => 'not-show'
                ],
                [
                    'id'      => 'donationShowInPages',
                    'title'   => esc_html__('Show in pages', 'cryptopay'),
                    'type'    => 'select',
                    'help'    => esc_html__('It allows you to add a donation box at the beginning or end of all the pages you share.', 'cryptopay'),
                    'options' => [
                        'not-show'      => esc_html__('Don\'t show', 'cryptopay'),
                        'show-in-begin' => esc_html__('Show in begin', 'cryptopay'),
                        'show-in-end'   => esc_html__('Show in end', 'cryptopay')
                    ],
                    'default' => 'not-show'
                ],
            ]
        ]);
    }
}
