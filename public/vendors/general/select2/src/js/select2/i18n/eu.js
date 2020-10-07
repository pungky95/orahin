/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

define(function () {
  // Basque
  return {
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'Idatzi ';

      if (overChars == 1) {
        message += 'karaktere bat';
      } else {
        message += overChars + ' karaktere';
      }

      message += ' gutxiago';

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Idatzi ';

      if (remainingChars == 1) {
        message += 'karaktere bat';
      } else {
        message += remainingChars + ' karaktere';
      }

      message += ' gehiago';

      return message;
    },
    loadingMore: function () {
      return 'Emaitza gehiago kargatzen…';
    },
    maximumSelected: function (args) {
      if (args.maximum === 1) {
        return 'Elementu bakarra hauta dezakezu';
      } else {
        return args.maximum + ' elementu hauta ditzakezu soilik';
      }
    },
    noResults: function () {
      return 'Ez da bat datorrenik aurkitu';
    },
    searching: function () {
      return 'Bilatzen…';
    }
  };
});
