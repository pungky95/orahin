/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

// Class definition

var KTBootstrapTouchspin = function () {

    // Private functions
    var demos = function () {
        // minimum setup
        //$('#kt_timepicker_1, #kt_timepicker_1_modal').timepicker();
    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

jQuery(document).ready(function() {
    KTBootstrapTouchspin.init();
});
