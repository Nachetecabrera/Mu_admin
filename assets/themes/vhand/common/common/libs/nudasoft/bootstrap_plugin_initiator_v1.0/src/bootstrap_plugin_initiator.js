/*!
|--------------------------------------------------------------------------
| Bootstrap plugin initiator
|
| Author:       Nudasoft
| Copyright:    Copyright (C) Nudasoft, all rights reserved
| Author email: nudasoft@gmail.com
| Author url:   http://www.nudasoft.com
|
| Author twitter:   https://twitter.com/Nudasoft
| Author facebook:  https://www.facebook.com/Nudasoft
| Author instagram: https://www.instagram.com/nudasoft
| Author linkedin:  https://www.linkedin.com/company/nudasoft
|--------------------------------------------------------------------------
*/

// Enable popovers everywhere.
$(function () {
    // Force fire popovers when it on the elements that have autofocus attribute.
    $('[data-toggle="popover"][autofocus]').popover('show');

    $('[data-toggle="popover"]').popover({
        trigger: 'focus'
    });
});
