/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

/* global jasmine, Waypoint */

'use strict'

jasmine.getFixtures().fixturesPath = 'test/fixtures'
jasmine.getEnv().defaultTimeoutInterval = 1000
Waypoint.requestAnimationFrame = function(callback) {
  callback()
}
