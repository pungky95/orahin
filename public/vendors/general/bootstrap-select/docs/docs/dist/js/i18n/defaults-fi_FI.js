/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

(function (root, factory) {
  if (root === undefined && window !== undefined) root = window;
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module unless amdModuleId is set
    define(["jquery"], function (a0) {
      return (factory(a0));
    });
  } else if (typeof module === 'object' && module.exports) {
    // Node. Does not work with strict CommonJS, but
    // only CommonJS-like environments that support module.exports,
    // like Node.
    module.exports = factory(require("jquery"));
  } else {
    factory(root["jQuery"]);
  }
}(this, function (jQuery) {

(function ($) {
  $.fn.selectpicker.defaults = {
    noneSelectedText: 'Ei valintoja',
    noneResultsText: 'Ei hakutuloksia {0}',
    countSelectedText: function (numSelected, numTotal) {
      return (numSelected == 1) ? '{0} valittu' : '{0} valitut';
    },
    maxOptionsText: function (numAll, numGroup) {
      return [
        (numAll == 1) ? 'Valintojen maksimimäärä ({n} saavutettu)' : 'Valintojen maksimimäärä ({n} saavutettu)',
        (numGroup == 1) ? 'Ryhmän maksimimäärä ({n} saavutettu)' : 'Ryhmän maksimimäärä ({n} saavutettu)'
      ];
    },
    selectAllText: 'Valitse kaikki',
    deselectAllText: 'Poista kaikki',
    multipleSeparator: ', '
  };
})(jQuery);


}));
