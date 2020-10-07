/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

var Remote = (function() {
  'use strict';

  // constructor
  // -----------

  function Remote(o) {
    this.url = o.url;
    this.prepare = o.prepare;
    this.transform = o.transform;

    this.transport = new Transport({
      cache: o.cache,
      limiter: o.limiter,
      transport: o.transport
    });
  }

  // instance methods
  // ----------------

  _.mixin(Remote.prototype, {
    // ### private

    _settings: function settings() {
      return { url: this.url, type: 'GET', dataType: 'json' };
    },

    // ### public

    get: function get(query, cb) {
      var that = this, settings;

      if (!cb) { return; }

      query = query || '';
      settings = this.prepare(query, this._settings());

      return this.transport.get(settings, onResponse);

      function onResponse(err, resp) {
        err ? cb([]) : cb(that.transform(resp));
      }
    },

    cancelLastRequest: function cancelLastRequest() {
      this.transport.cancel();
    }
  });

  return Remote;
})();
