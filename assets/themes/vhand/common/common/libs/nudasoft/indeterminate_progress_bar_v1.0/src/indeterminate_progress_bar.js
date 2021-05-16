/*!
|--------------------------------------------------------------------------
| Indeterminate progress bar
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

// Start progress bar.
function indeterminateProgressBarStart() {
    $('#injectionContainer').parent().append('<div class="indeterminateProgressBar"><div class="line"></div><div class="subline inc"></div><div class="subline dec"></div></div>');
}

// Remove progress bar.
function indeterminateProgressBarEnd() {
    var indeterminateProgressBarElement = $('#injectionContainer').parent().find('.indeterminateProgressBar');

    if (indeterminateProgressBarElement.length) {
        indeterminateProgressBarElement.remove();
    }
}
