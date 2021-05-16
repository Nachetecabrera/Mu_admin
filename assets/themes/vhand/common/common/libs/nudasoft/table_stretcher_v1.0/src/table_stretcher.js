/*!
|--------------------------------------------------------------------------
| Table stretcher
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

/**
 * This script will add "width: 100%" inline style rule for every table elements and it will make small
 * tables get stretched into their corresponding containers. can't use Bootstrap's "w-100" class for
 * this due to it can mess-up with the "fixed header" functionality.
 *
 * NOTE: This is not an issue or error. this is purely a design choice.
 */

$(function() {
    $('table').each(function() {
        $(this).css({
            'width' : '100%'
        });
    });
});
