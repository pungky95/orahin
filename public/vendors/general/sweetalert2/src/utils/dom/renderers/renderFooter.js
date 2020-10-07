/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

import * as dom from '../../dom/index.js'

export const renderFooter = (params) => {
  const footer = dom.getFooter()

  dom.toggle(footer, params.footer)

  if (params.footer) {
    dom.parseHtmlToContainer(params.footer, footer)
  }

  // Custom class
  dom.applyCustomClass(footer, params.customClass, 'footer')
}
