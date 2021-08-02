/**
 * Javascript for applying JQuery Autosize to textareas.
 *
 * @param {Object} $
 */

(function ($) {

Drupal.behaviors.jqueryscrollbar = {
  attach: function(context, settings) {
    var trigger = drupalSettings.jqueryscrollbar.trigger;
    if (trigger != null) {
      window.prettyPrint && prettyPrint();
      $(trigger).once('jqueryscrollbar').each(function () {
        $(this).addClass('scrollbar-' + settings.jqueryscrollbar.style).scrollbar(settings.jqueryscrollbar.options);
      });
    }
    if (settings.jqueryscrollbar.enable) {
      $('.scrollbar').once('jqueryscrollbar').each(function () {
        $(this).addClass('scrollbar-' + settings.jqueryscrollbar.style).scrollbar(settings.jqueryscrollbar.options);
      });
    }
  }
}

})(jQuery);
