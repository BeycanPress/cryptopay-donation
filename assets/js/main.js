(($) => {
    $(document).ready(() => {
        const donation = $(".cp-donation-container");

        donation.find('.choose-donate').click(function(e) {
            e.preventDefault();
            $(this).addClass('selected').siblings().removeClass('selected');
        });

        donation.find('.set-amount').keyup(function() {
            $(this).parent().attr("data-value", $(this).val());
        });

        donation.find('.donate-button').click(function() {
            let currency = donation.data('currency').toUpperCase();
            let amount = parseFloat(donation.find('.choose-donate.selected').attr('data-value'));

            if (!amount) {
                return Swal.fire({
                    title: CryptoPay.lang.donationAmount,
                    icon: 'info',
                    didOpen: () => {
                        Swal.hideLoading();
                    }
                })
            }

            let CryptoPayApp = CryptoPay.startPayment({
                amount,
                currency,
            });

            CryptoPayApp.events.add('transactionSent', (n, o, tx) => {
                cpHelpers.successPopup(CryptoPay.lang.transactionSent, `
                    <a href="${tx.getUrl()}" target="_blank">
                        ${CryptoPay.lang.openInExplorer}
                    </a>
                `).then(() => {
                    donation.show();
                    CryptoPayApp.reset();
                    donation.find('.set-amount').val('');
                });
            });

            donation.hide();
        });
    });
})(jQuery);