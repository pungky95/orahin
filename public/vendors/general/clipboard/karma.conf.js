/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

var webpackConfig = require('./webpack.config.js');

module.exports = function (karma) {
    karma.set({
        plugins: ['karma-webpack', 'karma-chai', 'karma-sinon', 'karma-mocha', 'karma-phantomjs-launcher'],

        frameworks: ['chai', 'sinon', 'mocha'],

        files: [
            'src/**/*.js',
            'test/**/*.js',
            './node_modules/phantomjs-polyfill/bind-polyfill.js'
        ],

        preprocessors: {
            'src/**/*.js': ['webpack'],
            'test/**/*.js': ['webpack']
        },

        webpack: {
            module: webpackConfig.module,
            plugins: webpackConfig.plugins
        },

        webpackMiddleware: {
            stats: 'errors-only'
        },

        browsers: ['PhantomJS']
    });
};
