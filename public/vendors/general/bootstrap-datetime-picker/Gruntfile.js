/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

module.exports = (grunt) => {

  require('load-grunt-tasks')(grunt)

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: {
        src: ['./js/bootstrap-datetimepicker.js']
      }
    },
    versioncheck: {
      target: {
        options: {
          hideUpToDate: true
        }
      }
    }
  })

  grunt.registerTask('default', ['jshint', 'versioncheck'])
}
