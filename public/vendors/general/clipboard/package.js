/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

// Package metadata for Meteor.js.

Package.describe({
  name: "zenorocha:clipboard",
  summary: "Modern copy to clipboard. No Flash. Just 3kb.",
  version: "2.0.4",
  git: "https://github.com/zenorocha/clipboard.js"
});

Package.onUse(function(api) {
  api.addFiles("dist/clipboard.js", "client");
});
