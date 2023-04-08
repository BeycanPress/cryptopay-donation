wp.blocks.registerBlockType('beycanpress/cryptopay-donation-box', {
    title: 'CryptoPay Donation Box',
    icon: 'dashicons dashicons-money-alt',
    category: 'widgets',
    edit: function() {
        return wp.element.createElement("div", null, '[cryptopay-donation-box]');
    },
    save: function() {
        return wp.element.createElement("div", null, '[cryptopay-donation-box]');
    }
});