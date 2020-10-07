/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

define( [
	"./cssExpand"
], function( cssExpand ) {
	"use strict";

	return new RegExp( cssExpand.join( "|" ), "i" );
} );
