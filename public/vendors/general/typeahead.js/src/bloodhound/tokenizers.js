/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

var tokenizers = (function() {
  'use strict';

  return {
    nonword: nonword,
    whitespace: whitespace,
    obj: {
      nonword: getObjTokenizer(nonword),
      whitespace: getObjTokenizer(whitespace)
    }
  };

  function whitespace(str) {
    str = _.toStr(str);
    return str ? str.split(/\s+/) : [];
  }

  function nonword(str) {
    str = _.toStr(str);
    return str ? str.split(/\W+/) : [];
  }

  function getObjTokenizer(tokenizer) {
    return function setKey(keys) {
      keys = _.isArray(keys) ? keys : [].slice.call(arguments, 0);

      return function tokenize(o) {
        var tokens = [];

        _.each(keys, function(k) {
          tokens = tokens.concat(tokenizer(_.toStr(o[k])));
        });

        return tokens;
      };
    };
  }
})();
