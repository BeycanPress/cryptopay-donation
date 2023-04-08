(function() {
    tinymce.PluginManager.add('beycanpress/cryptopay-donation-box', function( editor, url ) {
        editor.addButton('beycanpress/cryptopay-donation-box', {
            text: 'CryptoPay Donateion Box',
            icon: false,
            type: 'button',
            onclick: function() {
                editor.insertContent('[cryptopay-donation-box]');
            }
        });
    });
})();