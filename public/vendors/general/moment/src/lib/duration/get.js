/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

import { normalizeUnits } from '../units/aliases';
import absFloor from '../utils/abs-floor';

export function get (units) {
    units = normalizeUnits(units);
    return this.isValid() ? this[units + 's']() : NaN;
}

function makeGetter(name) {
    return function () {
        return this.isValid() ? this._data[name] : NaN;
    };
}

export var milliseconds = makeGetter('milliseconds');
export var seconds      = makeGetter('seconds');
export var minutes      = makeGetter('minutes');
export var hours        = makeGetter('hours');
export var days         = makeGetter('days');
export var months       = makeGetter('months');
export var years        = makeGetter('years');

export function weeks () {
    return absFloor(this.days() / 7);
}
