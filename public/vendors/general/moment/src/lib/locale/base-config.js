/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:34 PM
 */

import { defaultCalendar } from './calendar';
import { defaultLongDateFormat } from './formats';
import { defaultInvalidDate } from './invalid';
import { defaultOrdinal, defaultDayOfMonthOrdinalParse } from './ordinal';
import { defaultRelativeTime } from './relative';

// months
import {
    defaultLocaleMonths,
    defaultLocaleMonthsShort,
} from '../units/month';

// week
import { defaultLocaleWeek } from '../units/week';

// weekdays
import {
    defaultLocaleWeekdays,
    defaultLocaleWeekdaysMin,
    defaultLocaleWeekdaysShort,
} from '../units/day-of-week';

// meridiem
import { defaultLocaleMeridiemParse } from '../units/hour';

export var baseConfig = {
    calendar: defaultCalendar,
    longDateFormat: defaultLongDateFormat,
    invalidDate: defaultInvalidDate,
    ordinal: defaultOrdinal,
    dayOfMonthOrdinalParse: defaultDayOfMonthOrdinalParse,
    relativeTime: defaultRelativeTime,

    months: defaultLocaleMonths,
    monthsShort: defaultLocaleMonthsShort,

    week: defaultLocaleWeek,

    weekdays: defaultLocaleWeekdays,
    weekdaysMin: defaultLocaleWeekdaysMin,
    weekdaysShort: defaultLocaleWeekdaysShort,

    meridiemParse: defaultLocaleMeridiemParse
};
