/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

define(function () {
  // Indonesian
  return {
    errorLoading: function () {
      return 'Data tidak boleh diambil.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      return 'Hapuskan ' + overChars + ' huruf';
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      return 'Masukkan ' + remainingChars + ' huruf lagi';
    },
    loadingMore: function () {
      return 'Mengambil data…';
    },
    maximumSelected: function (args) {
      return 'Anda hanya dapat memilih ' + args.maximum + ' pilihan';
    },
    noResults: function () {
      return 'Tidak ada data yang sesuai';
    },
    searching: function () {
      return 'Mencari…';
    }
  };
});
