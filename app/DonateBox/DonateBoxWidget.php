<?php

namespace BeycanPress\CryptoPay\Donation\DonateBox;

use \BeycanPress\CryptoPay\PluginHero\Helpers;

class DonateBoxWidget extends \WP_Widget
{
    use Helpers;

    function __construct()
    {
        parent::__construct(
            __CLASS__, 
            esc_html__('# CryptoPay Donation Box', 'cryptopay'), 
            [
                'description' => esc_html__('With this widget you can add a box to your site to receive donations with cryptocurrencies.', 'cryptopay')
            ] 
        );
    }
    
    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
            
        print($args['before_widget']);
        
        $title = !empty($title) ? $title : esc_html__('CryptoPay Donation Box', 'cryptopay');

        print($args['before_title'] . $title . $args['after_title']);

        echo do_shortcode('[cryptopay-donation-box]');

        print($args['after_widget']);
    }
    
    public function form($instance) 
    {
        $title = isset($instance['title']) ? $instance['title'] : null;
        $this->viewEcho('widget-form', compact('title'));
    }
    
    public function update($newInstance, $oldInstance)
    {
        $instance = [];
        $instance['title'] = !empty($newInstance['title']) ? sanitize_text_field($newInstance['title']) : null;
        return $instance;
    }    
} 