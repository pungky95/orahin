/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

import parser from './parser';
import WhitespaceControl from './whitespace-control';
import * as Helpers from './helpers';
import { extend } from '../utils';

export { parser };

let yy = {};
extend(yy, Helpers);

export function parse(input, options) {
  // Just return if an already-compiled AST was passed in.
  if (input.type === 'Program') { return input; }

  parser.yy = yy;

  // Altering the shared object here, but this is ok as parser is a sync operation
  yy.locInfo = function(locInfo) {
    return new yy.SourceLocation(options && options.srcName, locInfo);
  };

  let strip = new WhitespaceControl(options);
  return strip.accept(parser.parse(input));
}
