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
    noneSelectedText: 'Tidak ada yang dipilih',
    noneResultsText: 'Tidak ada yang cocok {0}',
    countSelectedText: '{0} terpilih',
    maxOptionsText: ['Mencapai batas (maksimum {n})', 'Mencapai batas grup (maksimum {n})'],
    selectAllText: 'Pilih Semua',
    deselectAllText: 'Hapus Semua',
    multipleSeparator: ', '
  };
})(jQuery);


}));