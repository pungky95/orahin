/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

export var defaultOrdinal = '%d';
export var defaultDayOfMonthOrdinalParse = /\d{1,2}/;

export function ordinal (number) {
    return this._ordinal.replace('%d', number);
}

