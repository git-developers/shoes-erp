(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.handleSubmitRightSearch = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var boxRight = null;

        base.$el = $(el);
        base.el = el;
        base.$el.data('handleSubmitRightSearch', base);

        base.init = function(){
            var totalButtons = 0;
            boxRight = $('div#' + options.box_right_id);

            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.searchBox = function(event) {
            // debug(e);
            // base.options.buttonPress.call( this );

            if(event.keyCode == 13){ // enter pressed
                try{
                    event.preventDefault ? event.preventDefault() : (event.returnValue = false);

                    //DO ALTERNATE ACTION RATHER THAN SEND ENTER

                }catch(err){
                    console.log(err.message);
                }
            }
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.handleSubmitRightSearch.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.handleSubmitRightSearch = function(options){

        return this.each(function(){

            var bp = new $.handleSubmitRightSearch(this, options);

            $('div#' + options.box_right_id + ' input[name=' + options.box_search + ']').keypress(function(event) {
                bp.searchBox(event);
            });

        });

    };

})(jQuery);