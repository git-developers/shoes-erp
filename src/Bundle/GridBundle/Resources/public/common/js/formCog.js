(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formCog = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        base.$el = $(el);
        base.el = el;
        base.$el.data('formCog', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.redirect = function(event, context) {
            // debug(e);

            var id = $(context).parent().data('id');

            window.location.href = options.route.replace("/-1", "") + "/" + id;

        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.formCog = function(options){

        return this.each(function(){

            var bp = new $.formCog(this, options);

            $(document).on('click', 'td.' + options.buttonId, function() {
                bp.redirect(event, this);
            });

        });
    };

})(jQuery);