/*
 *  Copyright (c) 2020. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.com
 *  @date 1/23/20, 9:59 PM
 */

"use strict";
var KTAvatarDemo = {
    init: function () {
        new KTAvatar("kt_user_avatar_1"), new KTAvatar("kt_user_avatar_2"), new KTAvatar("kt_user_avatar_3"), new KTAvatar("kt_user_avatar_4")
    }
};
KTUtil.ready(function () {
    KTAvatarDemo.init()
});
