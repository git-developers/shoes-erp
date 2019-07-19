(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxLeftSearch = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var DELAY = 400;
        var base = this;
        var box = null;
        var globalTimeout = null;
        var msg_default = '<p><i class="fa fa-fw fa-info"></i> Seleccione un item.</p>';
        var msg_error = '<i class="fa fa-fw fa-warning"></i> Buscador izquierda Error: reintentar';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxLeftSearch', base);

        base.init = function(){
            var totalButtons = 0;
            box = $('div#' + options.boxId);
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.setMessageCallout = function(message){
            var div = box.find('.callout');
            div.html(message);
        };

        base.addClassCallout = function(addClass){
            var div = box.find('.callout');
            div.removeClass('callout-info').removeClass('callout-success').removeClass('callout-danger');
            div.addClass('callout-' + addClass);
        };

        base.searchBox = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var boxUl = box.find('ul');
            var q = $(context).val();

            if(globalTimeout != null){
                clearTimeout(globalTimeout);
            }

            globalTimeout = setTimeout(function() {

                $.ajax({
                    url: options.routeSearch,
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        q:q
                    },
                    cache: true,
                    beforeSend: function(jqXHR, settings) {
                        base.addClassCallout('info');
                        base.setMessageCallout(msg_default);
                    },
                    success: function(data, textStatus, jqXHR) {
                        boxUl.html(data);
                    },
                    error: function(jqXHR, exception) {
                        base.addClassCallout('danger');
                        base.setMessageCallout(msg_error);
                    }
                });

            }, DELAY);

        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        /*
        var isUserSelected = false;

        function setUserSelected(value) {
            isUserSelected = value;
        }
        */


        base.init();
    };

    // $.boxLeftSearch.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxLeftSearch = function(options){

        return this.each(function(){

            var bp = new $.boxLeftSearch(this, options);

            $('div#' + options.boxId + ' input[name=' + options.searchInputName + ']').keyup(function() {
                bp.searchBox(this);
            });

        });

    };

})(jQuery);