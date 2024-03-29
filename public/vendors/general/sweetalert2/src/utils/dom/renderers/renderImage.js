/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

import { swalClasses } from '../../classes.js'
import * as dom from '../../dom/index.js'

export const renderImage = (params) => {
  const image = dom.getImage()

  if (!params.imageUrl) {
    return dom.hide(image)
  }

  dom.show(image)

  // Src, alt
  image.setAttribute('src', params.imageUrl)
  image.setAttribute('alt', params.imageAlt)

  // Width, height
  dom.applyNumericalStyle(image, 'width', params.imageWidth)
  dom.applyNumericalStyle(image, 'height', params.imageHeight)

  // Class
  image.className = swalClasses.image
  dom.applyCustomClass(image, params.customClass, 'image')
  if (params.imageClass) {
    dom.addClass(image, params.imageClass)
  }
}
