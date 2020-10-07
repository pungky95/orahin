/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

if (typeof define === "function" && define.amd) define(function() {
    return typeof window !== "undefined" ? window : new (eval("require('jsdom').JSDOM"))("").window;
}); else if (typeof exports === "object") module.exports = typeof window !== "undefined" ? window : new (eval("require('jsdom').JSDOM"))("").window;
