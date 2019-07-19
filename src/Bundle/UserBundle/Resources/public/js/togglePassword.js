(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.togglePassword = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        base.$el = $(el);
        base.el = el;
        base.$el.data('togglePassword', base);

        base.init = function(){
            var totalButtons = 0;
        };

        base.togglePasswordFunction = function(context) {
            // debug(e);

            if ($(context).is(':checked')) {
                $('.' + options.password_input_class).attr('type', 'text');
            } else {
                $('.' + options.password_input_class).attr('type', 'password');
            }

        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.togglePassword = function(options){

        return this.each(function(){

            var bp = new $.togglePassword(this, options);

            $(document).on('click', 'input#' + options.checkbox_id, function() {
                bp.togglePasswordFunction(this);
            });

        });

    };

})(jQuery);