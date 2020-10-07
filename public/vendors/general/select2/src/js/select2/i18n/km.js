/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

define(function () {
  // Khmer
  return {
    errorLoading: function () {
      return 'មិនអាចទាញយកទិន្នន័យ';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'សូមលុបចេញ  ' + overChars + ' អក្សរ';

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'សូមបញ្ចូល' + remainingChars + ' អក្សរ រឺ ច្រើនជាងនេះ';

      return message;
    },
    loadingMore: function () {
      return 'កំពុងទាញយកទិន្នន័យបន្ថែម...';
    },
    maximumSelected: function (args) {
      var message = 'អ្នកអាចជ្រើសរើសបានតែ ' + args.maximum + ' ជម្រើសប៉ុណ្ណោះ';

      return message;
    },
    noResults: function () {
      return 'មិនមានលទ្ធផល';
    },
    searching: function () {
      return 'កំពុងស្វែងរក...';
    }
  };
});
