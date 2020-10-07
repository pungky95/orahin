/*
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

export default function(instance) {
  instance.registerHelper('lookup', function(obj, field) {
    return obj && obj[field];
  });
}
