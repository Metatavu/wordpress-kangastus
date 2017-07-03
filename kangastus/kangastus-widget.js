(function () {
  'use strict';

  jQuery(document).ready(function($) {
    if ($.fn.cs_wpColorPicker) {
      $('#kangastus-color-mask').cs_wpColorPicker();
    } else {
      $('#kangastus-color-mask').wpColorPicker();
    }
  });

}).call(this);