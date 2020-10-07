/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

define( function() {
	"use strict";

	return function isWindow( obj ) {
		return obj != null && obj === obj.window;
	};

} );