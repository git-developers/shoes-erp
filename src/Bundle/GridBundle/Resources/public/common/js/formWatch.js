(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formWatch = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        base.$el = $(el);
        base.el = el;
        base.$el.data('formWatch', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.redirect = function(event, context) {
            // debug(e);

            var slug = $(context).parent().parent().data('slug');

            window.location.href = options.route + "/" + slug;

        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.formWatch = function(options){

        return this.each(function(){

            var bp = new $.formWatch(this, options);

            $(document).on('click', 'button.' + options.buttonId, function() {
                bp.redirect(event, this);
            });

        });
    };

})(jQuery);