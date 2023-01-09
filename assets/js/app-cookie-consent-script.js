!(function($) {
    "use strict";

    $('#cookie-consent').cookieConsent();

    $('.cancel-button').click(function(){
        $('#cookie-consent').toggle();
    });

})(jQuery);