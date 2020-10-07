/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

declare namespace PerfectScrollbar {
  export interface Options {
    handlers?: string[];
    maxScrollbarLength?: number;
    minScrollbarLength?: number;
    scrollingThreshold?: number;
    scrollXMarginOffset?: number;
    scrollYMarginOffset?: number;
    suppressScrollX?: boolean;
    suppressScrollY?: boolean;
    swipeEasing?: boolean;
    useBothWheelAxes?: boolean;
    wheelPropagation?: boolean;
    wheelSpeed?: number;
  }
}

declare class PerfectScrollbar {
  constructor(element: string | HTMLElement, options?: PerfectScrollbar.Options);

  update(): void;
  destroy(): void;

  reach: { x: 'start' | 'end' | null, y: 'start' | 'end' | null };
}

export default PerfectScrollbar;
