/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

export const parseHtmlToContainer = (param, target) => {
  // DOM element
  if (param instanceof HTMLElement) {
    target.appendChild(param)

  // JQuery element(s)
  } else if (typeof param === 'object') {
    handleJqueryElem(target, param)

  // Plain string
  } else if (param) {
    target.innerHTML = param
  }
}

const handleJqueryElem = (target, elem) => {
  target.innerHTML = ''
  if (0 in elem) {
    for (let i = 0; i in elem; i++) {
      target.appendChild(elem[i].cloneNode(true))
    }
  } else {
    target.appendChild(elem.cloneNode(true))
  }
}
