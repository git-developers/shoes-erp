(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formTicketEdit = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        base.$el = $(el);
        base.el = el;
        base.$el.data('formTicketEdit', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.redirect = function(event, context) {
            // debug(e);

            var id = $(context).parent().parent().data('id');

            window.location.href = options.route + "/" + id;

        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.formTicketEdit = function(options){

        return this.each(function(){

            var bp = new $.formTicketEdit(this, options);

            $(document).on('click', 'button.' + options.buttonId, function() {
                bp.redirect(event, this);
            });

        });
    };

})(jQuery);