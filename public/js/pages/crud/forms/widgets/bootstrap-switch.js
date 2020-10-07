/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

// Class definition

var KTBootstrapSwitch = function() {

  // Private functions
  var demos = function() {
    // minimum setup
    $('[data-switch=true]').bootstrapSwitch();
  };

  return {
    // public functions
    init: function() {
      demos();
    },
  };
}();

jQuery(document).ready(function() {
  KTBootstrapSwitch.init();
});
