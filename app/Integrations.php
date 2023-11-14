<?php

namespace BeycanPress\CryptoPay\Donation;

use BeycanPress\CryptoPay\PluginHero\Helpers;

class Integrations
{
    use Helpers;
    
    public function __construct()
    {
        // Register widget
        add_action('widgets_init', function() {
            register_widget(DonateBox\DonateBoxWidget::class);
        });

        if (is_admin()) {
            // Register Gutenberg block
            add_action('enqueue_block_editor_assets', function() {
                global $pagenow;
                $dependencies = $pagenow === 'widgets.php' ? ['wp-edit-widgets'] : ['wp-editor'];

                $this->addons->donation->addScript('gutenberg.js', array_merge($dependencies, ['jquery', 'wp-element', 'wp-blocks']));
            });    

            // Register TinyMCE button
            add_action('admin_head', function() {
                add_filter('mce_external_plugins', function($pluginArray) {
                    $pluginArray['beycanpress/cryptopay-donation-box'] = plugin_dir_url('cryptopay-donation/index.php') . 'assets/js/tinymce.js';
                    return $pluginArray;
                });
                add_filter('mce_buttons', function($buttons) {
                    array_push($buttons, 'beycanpress/cryptopay-donation-box');
                    return $buttons;
                });
            });
        } else {
            add_filter('the_content', function($content) {
                
                if (function_exists('WC')) {
                    if (is_checkout() || is_account_page() || is_woocommerce() || is_cart()) return $content;
				}

                if (is_page() || is_single()) {
                    $showIn = is_page() ? $this->setting('donationShowInPages') : $this->setting('donationShowInPosts');
                    
                    if ($showIn == 'show-in-begin') {
                        $content = do_shortcode('[cryptopay-donation-box]') . $content;
                    } elseif ($showIn == 'show-in-end') {
                        $content .= do_shortcode('[cryptopay-donation-box]');
                    }
                }

                return $content;
            });
        }
    }
}