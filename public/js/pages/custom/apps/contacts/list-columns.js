/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

"use strict";

// Class definition
var KTAppContactsListColumns = function () {

	// Private functions
	var initAside = function () {
		// Mobile offcanvas for mobile mode
		var offcanvas = new KTOffcanvas('kt_contact_aside', {
            overlay: true,
            baseClass: 'kt-app__aside',
            closeBy: 'kt_contact_aside_close',
            toggleBy: 'kt_subheader_mobile_toggle'
        });
	}

	return {
		// public functions
		init: function() {
			initAside();
		}
	};
}();

KTUtil.ready(function() {
	KTAppContactsListColumns.init();
});
