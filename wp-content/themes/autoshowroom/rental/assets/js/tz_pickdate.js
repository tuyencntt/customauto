/**
 * File Name
 */
(function ($) {
    'use strict';
    $(document).ready(function() {
        var $startDate = $('.start-date');
        var $endDate = $('.end-date');

        $startDate.datepicker({
            autoHide: true,
            startDate: 'a',
            format: 'dd/mm/yyyy',
        });
        $endDate.datepicker({
            autoHide: true,
            format: 'dd/mm/yyyy',
            startDate: $startDate.datepicker('getDate'),
        });

        $startDate.on('change', function () {
            $endDate.datepicker('setStartDate', $startDate.datepicker('getDate'));
        });
    });

})(jQuery);