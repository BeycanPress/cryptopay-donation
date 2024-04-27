<?php

declare(strict_types=1);

namespace BeycanPress\CryptoPay\Donation\DonateBox;

use BeycanPress\CryptoPay\Helpers;

class DonateBoxWidget extends \WP_Widget
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(
            __CLASS__,
            esc_html__('# CryptoPay Donation Box', 'cryptopay'),
            [
                // @phpcs:ignore
                'description' => esc_html__('With this widget you can add a box to your site to receive donations with cryptocurrencies.', 'cryptopay')
            ]
        );
    }

    /**
     * Widget
     *
     * @param array<string,string> $args
     * @param array<string,string> $instance
     * @return void
     */
    // @phpcs:ignore
    public function widget($args, $instance): void
    {
        $title = apply_filters('widget_title', $instance['title']);

        print($args['before_widget']);

        $title = !empty($title) ? $title : esc_html__('CryptoPay Donation Box', 'cryptopay');

        print($args['before_title'] . $title . $args['after_title']);

        echo do_shortcode('[cryptopay-donation-box]');

        print($args['after_widget']);
    }

    /**
     * Form
     *
     * @param array<string,string> $instance
     * @return void
     */
    // @phpcs:ignore
    public function form($instance)
    {
        /** @disregard */
        if (!$this->get_field_id) {
            return;
        }
        $title = isset($instance['title']) ? $instance['title'] : null;
        return Helpers::getAddon('donation')->view('widget-form', compact('title'));
    }

    /**
     * Update
     *
     * @param array<string,string> $newInstance
     * @param array<string,string> $oldInstance
     * @return array<string,string>
     */
    // @phpcs:ignore
    public function update($newInstance, $oldInstance)
    {
        $instance = [];
        $instance['title'] = !empty($newInstance['title']) ? sanitize_text_field($newInstance['title']) : null;
        return $instance;
    }
}
