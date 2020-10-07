/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

export default function isArray(input) {
    return input instanceof Array || Object.prototype.toString.call(input) === '[object Array]';
}
