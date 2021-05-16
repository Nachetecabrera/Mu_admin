/*!
|--------------------------------------------------------------------------
| Password visibility toggler
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

// Bootstrap v4.x
$(function() {
    var passwordGroupElement = $('div[_password_visibility_toggle]');
    passwordGroupElement.each(function() {
        var passwordInputField = $(this).find('input[type="password"]');
        passwordInputField.on('input', function() {
            var passwordInputFieldValue = $(this).val();
            var inputGroupAppend = $(this).parent().find('div.input-group-append');
            var visibilityToggleButtonIconShow = '<i class="fas fa-eye"></i>';
            var visibilityToggleButtonIconHide = '<i class="fas fa-eye-slash"></i>';
            var visibilityToggleButton = $('<button class="btn btn-outline-secondary" type="button" _visibility_toggle_button>' + visibilityToggleButtonIconShow + '</button>');
            if (passwordInputFieldValue != '') {
                if (inputGroupAppend.children().length == 0) {
                    $(this).parent().addClass('input-group');

                    if ($(this).parent().find('div.input-group-append button[_visibility_toggle_button]').length == 0) {
                        inputGroupAppend.prepend(visibilityToggleButton[0].outerHTML);
                        $(this).parent().find('div button[_visibility_toggle_button]').addClass('rounded-right'); // Due to bootstrap's bug.
                    }
                } else {
                    if ($(this).parent().find('div.input-group-append button[_visibility_toggle_button]').length == 0) {
                        inputGroupAppend.prepend(visibilityToggleButton[0].outerHTML);
                    }
                }

                visibilityToggleButton = $(this).parent().find('div button[_visibility_toggle_button]');

                visibilityToggleButton.bind('mousedown keydown touchstart', function() {
                    passwordInputField.attr('type', 'text');
                    visibilityToggleButton.html(visibilityToggleButtonIconHide);
                });

                visibilityToggleButton.bind('mouseup mouseleave keyup focusout touchend touchcancel', function() {
                    passwordInputField.attr('type', 'password');
                    visibilityToggleButton.html(visibilityToggleButtonIconShow);
                });
            } else {
                $(this).parent().find('div.input-group-append button[_visibility_toggle_button]').remove();

                if (inputGroupAppend.children().length == 0) {
                    $(this).parent().removeClass('input-group');
                }
            }
        });
    });
});
