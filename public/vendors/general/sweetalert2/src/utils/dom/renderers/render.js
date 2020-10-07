/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

import { renderActions } from './renderActions'
import { renderContainer } from './renderContainer'
import { renderContent } from './renderContent'
import { renderFooter } from './renderFooter'
import { renderHeader } from './renderHeader'
import { renderPopup } from './renderPopup'

export const render = (params) => {
  renderPopup(params)
  renderContainer(params)

  renderHeader(params)
  renderContent(params)
  renderActions(params)
  renderFooter(params)
}
