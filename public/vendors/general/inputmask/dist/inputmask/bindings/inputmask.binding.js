/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

(function(factory) {
    if (typeof define === "function" && define.amd) {
        define([ "jquery", "../inputmask", "../global/window" ], factory);
    } else if (typeof exports === "object") {
        module.exports = factory(require("jquery"), require("../inputmask"), require("../global/window"));
    } else {
        factory(jQuery, window.Inputmask, window);
    }
})(function($, Inputmask, window) {
    $(window.document).ajaxComplete(function(event, xmlHttpRequest, ajaxOptions) {
        if ($.inArray("html", ajaxOptions.dataTypes) !== -1) {
            $(".inputmask, [data-inputmask], [data-inputmask-mask], [data-inputmask-alias]").each(function(ndx, lmnt) {
                if (lmnt.inputmask === undefined) {
                    Inputmask().mask(lmnt);
                }
            });
        }
    }).ready(function() {
        $(".inputmask, [data-inputmask], [data-inputmask-mask], [data-inputmask-alias]").each(function(ndx, lmnt) {
            if (lmnt.inputmask === undefined) {
                Inputmask().mask(lmnt);
            }
        });
    });
});
