/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

define( [
	"../var/support"
], function( support ) {

"use strict";

support.focusin = "onfocusin" in window;

return support;

} );
