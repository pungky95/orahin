/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

import registerBlockHelperMissing from './helpers/block-helper-missing';
import registerEach from './helpers/each';
import registerHelperMissing from './helpers/helper-missing';
import registerIf from './helpers/if';
import registerLog from './helpers/log';
import registerLookup from './helpers/lookup';
import registerWith from './helpers/with';

export function registerDefaultHelpers(instance) {
  registerBlockHelperMissing(instance);
  registerEach(instance);
  registerHelperMissing(instance);
  registerIf(instance);
  registerLog(instance);
  registerLookup(instance);
  registerWith(instance);
}
