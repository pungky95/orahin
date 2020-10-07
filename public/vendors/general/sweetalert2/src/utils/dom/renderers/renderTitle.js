/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

import * as dom from '../../dom/index.js'

export const renderTitle = (params) => {
  const title = dom.getTitle()

  dom.toggle(title, params.title || params.titleText)

  if (params.title) {
    dom.parseHtmlToContainer(params.title, title)
  }

  if (params.titleText) {
    title.innerText = params.titleText
  }

  // Custom class
  dom.applyCustomClass(title, params.customClass, 'title')
}
