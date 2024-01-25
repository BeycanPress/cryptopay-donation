<?php

declare(strict_types=1);

namespace BeycanPress\CryptoPay\Donation;

class Lang
{
    /**
     * @return array<string,string>
     */
    public static function get(): array
    {
        return [
            "orderAmount" => esc_html__('Donate amount', 'cryptopay'),
            "paymentCurrency" => esc_html__('Donate currency', 'cryptopay'),
            "payNow" => esc_html__('Donate now', 'cryptopay'),
            "amountToBePaid" => esc_html__('Amount to be donated', 'cryptopay'),
            "paymentRejected" => esc_html__('Donation rejected!', 'cryptopay'),
            "paymentAddress" => esc_html__('Donation address:', 'cryptopay'),
            "paymentTimedOut" => esc_html__('Donation timed out!', 'cryptopay'),
            "donationAmount" => esc_html('Please choose donation amount!', 'cryptopay'),
            "transactionSent" => esc_html__('Donate sent', 'cryptopay'),
            "paymentTimedOut" => esc_html__('Donation timed out!', 'cryptopay'),
        ];
    }
}
