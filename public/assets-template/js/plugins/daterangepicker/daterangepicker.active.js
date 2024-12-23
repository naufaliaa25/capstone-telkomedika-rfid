(function ($) {
    "use strict";
    
    /*Input Date*/
    if( $('.input-date').length ) {
        $('.input-date').daterangepicker();
    }
    
    /*Input Date & Time*/
    if( $('.input-date-time').length ) {
        $('.input-date-time').daterangepicker({
            timePicker: true,
        });
    }
    
    /*Input Date Single*/
    if( $('.input-date-single').length ) {
        $('.input-date-single').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
        });
    }
    
    /*Input Date Empty*/
    if( $('.input-date-empty').length ) {
        $('.input-date-empty').daterangepicker({
            autoUpdateInput: false,
        });
    }

    /*Input Date Predefined*/
    if( $('.input-date-predefined').length ) {
        var start = moment().subtract(29, 'days');
        var end = moment();
        function cb(start, end) {
            $('.input-date-predefined').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('.input-date-predefined').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'Last 60 Days': [moment().subtract(60, 'days'), moment()],
                'Last 90 Days': [moment().subtract(90, 'days'), moment()],
                'Last 120 Days': [moment().subtract(120, 'days'), moment()],
                'Last 150 Days': [moment().subtract(150, 'days'), moment()],
                'All Time': ['04/01/2021', moment()],
            },
        }, cb);
        cb(start, end);
    }
    
})(jQuery);