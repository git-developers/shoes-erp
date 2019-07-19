(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formProfile = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var addFriend = null;
        var removeFriend = null;

        base.$el = $(el);
        base.el = el;
        base.$el.data('formProfile', base);

        base.init = function(){
            var totalButtons = 0;

            addFriend = $('button.' + options.buttonAddFriend);
            removeFriend = $('button.' + options.buttonRemoveFriend);
        };

        base.addFriend = function(event, context) {
            // debug(e);

            $.ajax({
                url: options.routeAddFriend,
                type: 'PUT',
                dataType: 'json',
                data: {},
                beforeSend: function(jqXHR, settings) {
                    removeFriend.show();
                    addFriend.hide();
                },
                success: function(data, textStatus, jqXHR) {

                },
                error: function(jqXHR, exception) {

                }
            });
        };

        base.removeFriend = function(event, context) {
            // debug(e);

            $.ajax({
                url: options.routeRemoveFriend,
                type: 'PUT',
                dataType: 'json',
                data: {},
                beforeSend: function(jqXHR, settings) {
                    removeFriend.hide();
                    addFriend.show();
                },
                success: function(data, textStatus, jqXHR) {

                },
                error: function(jqXHR, exception) {

                }
            });
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.formProfile.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.formProfile = function(options){

        return this.each(function(){

            var bp = new $.formProfile(this, options);

            $(document).on('click', 'button.' + options.buttonAddFriend, function() {
                bp.addFriend(event, this);
            });

            $(document).on('click', 'button.' + options.buttonRemoveFriend, function() {
                bp.removeFriend(event, this);
            });



        });
    };

})(jQuery);