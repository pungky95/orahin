/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

var DefaultMenu = (function() {
  'use strict';

  var s = Menu.prototype;

  function DefaultMenu() {
    Menu.apply(this, [].slice.call(arguments, 0));
  }

  _.mixin(DefaultMenu.prototype, Menu.prototype, {
    // overrides
    // ---------

    open: function open() {
      // only display the menu when there's something to be shown
      !this._allDatasetsEmpty() && this._show();
      return s.open.apply(this, [].slice.call(arguments, 0));
    },

    close: function close() {
      this._hide();
      return s.close.apply(this, [].slice.call(arguments, 0));
    },

    _onRendered: function onRendered() {
      if (this._allDatasetsEmpty()) {
        this._hide();
      }

      else {
        this.isOpen() && this._show();
      }

      return s._onRendered.apply(this, [].slice.call(arguments, 0));
    },

    _onCleared: function onCleared() {
      if (this._allDatasetsEmpty()) {
        this._hide();
      }

      else {
        this.isOpen() && this._show();
      }

      return s._onCleared.apply(this, [].slice.call(arguments, 0));
    },

    setLanguageDirection: function setLanguageDirection(dir) {
      this.$node.css(dir === 'ltr' ? this.css.ltr : this.css.rtl);
      return s.setLanguageDirection.apply(this, [].slice.call(arguments, 0));
    },

    // private
    // ---------

    _hide: function hide() {
      this.$node.hide();
    },

    _show: function show() {
      // can't use jQuery#show because $node is a span element we want
      // display: block; not dislay: inline;
      this.$node.css('display', 'block');
    }
  });

  return DefaultMenu;
})();
