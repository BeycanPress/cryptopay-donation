(($) => {
    $(document).ready(() => {
        const cryptopay = $("#cryptopay");
        const donation = $(".cp-donation-container");

        donation.find('.choose-donate').click(function(e) {
            e.preventDefault();
            $(this).addClass('selected').siblings().removeClass('selected');
        });

        donation.find('.set-amount').keyup(function() {
            $(this).parent().attr("data-value", $(this).val());
        });

        let startedApp;
        const autoStarter = (order, params) => {
            if (!startedApp) {
                startedApp = window.CryptoPayApp.start(order, params);
            } else {
                startedApp.reStart(order, params);
            }
        }

        donation.find('.donate-button').click(function() {
            let currency = donation.data('currency').toUpperCase();
            let amount = parseFloat(donation.find('.choose-donate.selected').attr('data-value'));

            if (!amount) {
                return Swal.fire({
                    title: window.CryptoPayLang.donationAmount,
                    icon: 'info',
                    didOpen: () => {
                        Swal.hideLoading();
                    }
                })
            }

            autoStarter({
                amount, currency
            })

            window.CryptoPayApp.events.add('transactionCreated', ({transaction}) => {
                cpHelpers.successPopup(window.CryptoPayLang.transactionSent, `
                    <a href="${transaction.getUrl()}" target="_blank">
                        ${window.CryptoPayLang.openInExplorer}
                    </a>
                `).then(() => {
                    donation.show();
                    cryptopay.hide();
                    startedApp.store.payment.$reset();
                    donation.find('.set-amount').val('');
                });
            });

            donation.hide();
            cryptopay.show();
        });
    });
})(jQuery);