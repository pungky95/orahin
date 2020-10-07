/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

// Detect Node env
export const isNodeEnv = () => typeof window === 'undefined' || typeof document === 'undefined'
