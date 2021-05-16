/*!
|--------------------------------------------------------------------------
| Bootstrap auto close alerts
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

$(function() {
    var alert = $('div.alert[_auto_close]');
    alert.each(function() {
        var alert = $(this);
        var autoCloseTime = $(this).attr('_auto_close');

        setTimeout(function() {
            alert.alert('close');
        }, autoCloseTime);
    });
});
