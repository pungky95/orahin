/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

import * as dom from '../../dom/index.js'
import { renderCloseButton } from './renderCloseButton'
import { renderIcon } from './renderIcon'
import { renderImage } from './renderImage'
import { renderProgressSteps } from './renderProgressSteps'
import { renderTitle } from './renderTitle'

export const renderHeader = (params) => {
  const header = dom.getHeader()

  // Custom class
  dom.applyCustomClass(header, params.customClass, 'header')

  // Progress steps
  renderProgressSteps(params)

  // Icon
  renderIcon(params)

  // Image
  renderImage(params)

  // Title
  renderTitle(params)

  // Close button
  renderCloseButton(params)
}
