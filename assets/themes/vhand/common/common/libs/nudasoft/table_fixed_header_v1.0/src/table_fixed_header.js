/*!
|--------------------------------------------------------------------------
| Table fixed header handler
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
 * Note: style="position: relative;" attribute get added for every selected element by the ResizeSensor library not by the bellow code.
 */

function tableFixedHeader() {
    $('table[_fixed_header]').each(function() {
        if ($(this).children('tbody').length == 1) {
            // Tricky vars.
            var frameOffsetTop = $('#content').offset().top;
            var scrollTopHeight = $('#content').scrollTop();
            var tableOffsetTop = ($(this).offset().top + $('#content').scrollTop()) - frameOffsetTop;
            var tableOffsetLeft = $(this).offset().left;

            // Cool vars.
            var tableWrapperWidth = $(this).parent().outerWidth();
            var tableWidth = $(this).outerWidth();
            var tableHeight = $(this).outerHeight();
            var tableLastRowHeight = $(this).find('tbody tr:last').outerHeight();
            var tableHeaderHeight = $(this).find('thead').outerHeight();
            var tableFooterHeight = ($(this).find('tfoot').length == 1) ? $(this).find('tfoot').outerHeight() : 0;
            var tableStickyHeader = $(this).parent().children('table._sticky_header');
            var tableThead = $(this).children('thead');

            // Add necessary styles to table parent.
            $(this).parent().css({ 'position': 'relative' });

            // Generate updated thead th tag string.
            var thString = '';
            tableThead.find('tr th').each(function () {
                var th = $(this).css({ 'width': $(this).outerWidth() + 'px' });
                thString = thString + th[0].outerHTML;
            });

            // Main state of floating.
            if (scrollTopHeight >= tableOffsetTop && scrollTopHeight <= tableOffsetTop + (tableHeight - (tableHeaderHeight + tableLastRowHeight + tableFooterHeight))) {

                var tableStickyHeaderInjection = $('<table></table>').addClass('_sticky_header ' + $(this).attr('class'));
                tableStickyHeaderInjection.append($('<thead><tr>' + thString + '</tr></thead>').addClass(tableThead.attr('class')));

                tableStickyHeaderInjection.css({
                    'z-index' : '500'
                });

                // When overflow not happening.
                if (tableWrapperWidth == tableWidth) {
                    // Add floating table.
                    if (tableStickyHeader.length == 0) {
                        tableStickyHeaderInjection.css({
                            'visibility': 'visible',
                            'position': 'fixed',
                            'left': tableOffsetLeft + 'px',
                            'top': frameOffsetTop + 'px',
                            'width': tableWidth + 'px'
                        });

                        $(this).before(tableStickyHeaderInjection[0].outerHTML);
                    // Update th tags.
                    } else {
                        tableStickyHeader.find('tr').html(thString);

                        tableStickyHeader.css({
                            'visibility': 'visible',
                            'position': 'fixed',
                            'left': tableOffsetLeft + 'px',
                            'top': frameOffsetTop + 'px',
                            'width': tableWidth + 'px'
                        });
                    }
                // When overflow happening.
                } else {
                    // Add floating table.
                    if (tableStickyHeader.length == 0) {
                        tableStickyHeaderInjection.css({
                            'visibility': 'visible',
                            'position': 'absolute',
                            'left': '0',
                            'top': (scrollTopHeight - tableOffsetTop) + 'px',
                            'width': tableWidth + 'px'
                        });

                        $(this).before(tableStickyHeaderInjection[0].outerHTML);
                    // Update th tags.
                    } else {
                        tableStickyHeader.find('tr').html(thString);

                        tableStickyHeader.css({
                            'visibility': 'visible',
                            'position': 'absolute',
                            'left': '0',
                            'top': (scrollTopHeight - tableOffsetTop) + 'px',
                            'width': tableWidth + 'px'
                        });
                    }
                }
            // Right before last table row floating.
            } else if (scrollTopHeight >= tableOffsetTop + (tableHeight - (tableHeaderHeight + tableLastRowHeight + tableFooterHeight)) && scrollTopHeight <= (tableOffsetTop + tableHeight)) {
                tableStickyHeader.find('tr').html(thString);

                tableStickyHeader.css({
                    'visibility': 'visible',
                    'position': 'absolute',
                    'left': '0',
                    'top': (tableHeight - (tableHeaderHeight + tableLastRowHeight + tableFooterHeight)) + 'px',
                    'width': tableWidth + 'px'
                });
            // Make sticky table hidden.
            } else {
                if (tableStickyHeader.length == 1) {
                    tableStickyHeader.css({
                        'visibility': 'hidden'
                    });
                }
            }
        }
    });
}

$(function() {
    // Events.
    $('#content').scroll(function () {
        tableFixedHeader();
    });

    $(window).resize(function () {
        tableFixedHeader();
    });

    new ResizeSensor($('table'), function () {
        tableFixedHeader();
    });
});
