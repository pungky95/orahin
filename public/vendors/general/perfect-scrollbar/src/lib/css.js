/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

export function get(element) {
  return getComputedStyle(element);
}

export function set(element, obj) {
  for (const key in obj) {
    let val = obj[key];
    if (typeof val === 'number') {
      val = `${val}px`;
    }
    element.style[key] = val;
  }
  return element;
}
