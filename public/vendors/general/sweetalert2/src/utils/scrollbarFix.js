/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

import * as dom from './dom/index.js'

export const fixScrollbar = () => {
  // for queues, do not do this more than once
  if (dom.states.previousBodyPadding !== null) {
    return
  }
  // if the body has overflow
  if (document.body.scrollHeight > window.innerHeight) {
    // add padding so the content doesn't shift after removal of scrollbar
    dom.states.previousBodyPadding = parseInt(window.getComputedStyle(document.body).getPropertyValue('padding-right'))
    document.body.style.paddingRight = (dom.states.previousBodyPadding + dom.measureScrollbar()) + 'px'
  }
}

export const undoScrollbar = () => {
  if (dom.states.previousBodyPadding !== null) {
    document.body.style.paddingRight = dom.states.previousBodyPadding + 'px'
    dom.states.previousBodyPadding = null
  }
}
