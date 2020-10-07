/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

import * as dom from '../../dom/index.js'

export const renderCloseButton = (params) => {
  const closeButton = dom.getCloseButton()

  // Custom class
  dom.applyCustomClass(closeButton, params.customClass, 'closeButton')

  dom.toggle(closeButton, params.showCloseButton)
  closeButton.setAttribute('aria-label', params.closeButtonAriaLabel)
}
