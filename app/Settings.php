<?php 

namespace BeycanPress\CryptoPay\Donation;

use BeycanPress\CryptoPay\Services;
use BeycanPress\CryptoPay\PluginHero\Setting;

class Settings
{
    public function __construct()
    {
        Setting::createSection(array(    
            'id'     => 'donate', 
            'title'  => esc_html__('Donation settings', 'cryptopay'),
            'icon'   => 'fas fa-donate',
            'fields' => array(
                array(
                    'id'      => 'donationShortCode',
                    'title'   => esc_html__('Shorcode', 'cryptopay'),
                    'type'    => 'content',
                    'content' => '[cryptopay-donation-box]'
                ),
                array(
                    'id'    => 'donationCurrency',
                    'type'  => 'select',
                    'title' => esc_html__('Currency', 'cryptopay'),
                    'options' => Services::getCountryCurrencies(),
                    'default' => 'USD'
                ),
                array(
                    'id'      => 'donationDonateAmounts',
                    'type'    => 'group',
                    'title'   => esc_html__('Donate amounts', 'cryptopay'),
                    'button_title' => esc_html__('Add new', 'cryptopay'),
                    'fields'      => array(
                        array(
                            'title' => esc_html__('Value', 'cryptopay'),
                            'id'    => 'value',
                            'type'  => 'number',
                        ),
                    ),
                    'default' => array(
                        array(
                            'value' => 10
                        ),
                        array(
                            'value' => 30
                        ),
                        array(
                            'value' => 50
                        ),
                        array(
                            'value' => 100
                        )
                    )
                ),
                array(
                    'id'      => 'donationShowInPosts',
                    'title'   => esc_html__('Show in posts', 'cryptopay'),
                    'type'    => 'select',
                    'help'    => esc_html__('It allows you to add a donation box at the beginning or end of all the posts you share.', 'cryptopay'),
                    'options' => [
                        'not-show'      => esc_html__('Not show', 'cryptopay'),
                        'show-in-begin' => esc_html__('Show in begin', 'cryptopay'),
                        'show-in-end'   => esc_html__('Show in end', 'cryptopay')
                    ],
                    'default' => 'not-show'
                ),
                array(
                    'id'      => 'donationShowInPages',
                    'title'   => esc_html__('Show in pages', 'cryptopay'),
                    'type'    => 'select',
                    'help'    => esc_html__('It allows you to add a donation box at the beginning or end of all the pages you share.', 'cryptopay'),
                    'options' => [
                        'not-show'      => esc_html__('Not show', 'cryptopay'),
                        'show-in-begin' => esc_html__('Show in begin', 'cryptopay'),
                        'show-in-end'   => esc_html__('Show in end', 'cryptopay')
                    ],
                    'default' => 'not-show'
                ),
            )
        ));
    }
}