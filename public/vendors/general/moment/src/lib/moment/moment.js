/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

import { createLocal } from '../create/local';
import { createUTC } from '../create/utc';
import { createInvalid } from '../create/valid';
import { isMoment } from './constructor';
import { min, max } from './min-max';
import { now } from './now';
import momentPrototype from './prototype';

function createUnix (input) {
    return createLocal(input * 1000);
}

function createInZone () {
    return createLocal.apply(null, arguments).parseZone();
}

export {
    now,
    min,
    max,
    isMoment,
    createUTC,
    createUnix,
    createLocal,
    createInZone,
    createInvalid,
    momentPrototype
};
