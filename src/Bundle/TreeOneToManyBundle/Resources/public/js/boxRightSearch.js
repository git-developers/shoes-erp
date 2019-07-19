(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightSearch = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var DELAY = 400;
        var base = this;
        var boxLeft = null;
        var boxRight = null;
        var globalTimeout = null;
        var msg_default = '<p><i class="fa fa-fw fa-info"></i> Seleccione un item.</p>';
        var msg_error = '<i class="fa fa-fw fa-warning"></i> Buscador derecha Error: reintentar';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightSearch', base);

        base.init = function(){
            var totalButtons = 0;
            boxLeft = $('div#' + options.boxLeftId);
            boxRight = $('div#' + options.boxRightId);
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');
        };

        base.setMessageCallout = function(message){
            var div = boxLeft.find('.callout');
            div.html(message);
        };

        base.addClassCallout = function(addClass){
            var div = boxLeft.find('.callout');
            div.removeClass('callout-info').removeClass('callout-success').removeClass('callout-danger');
            div.addClass('callout-' + addClass);
        };

        base.searchBox = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var radioLeftValue = boxLeft.find('input[type=radio]:checked').val();

            var boxUl = boxRight.find('ul');
            var q = $(context).val();
            // var fields = $("form[name='" + options.form_name + "']").serializeArray();

            if(globalTimeout != null){
                clearTimeout(globalTimeout);
            }

            globalTimeout = setTimeout(function() {

                $.ajax({
                    url: options.routeSearch,
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        q:q,
                        radioLeftValue:radioLeftValue
                    },
                    cache: true,
                    beforeSend: function(jqXHR, settings) {
                        boxRight.find('i.fa-refresh').show();
                    },
                    success: function(data, textStatus, jqXHR) {
                        boxRight.find('i.fa-refresh').hide();
                        boxUl.html(data);
                    },
                    error: function(jqXHR, exception) {
                        base.addClassCallout('danger');
                        base.setMessageCallout(msg_error);
                        boxRight.find('i.fa-refresh').hide();
                    }
                });

            }, DELAY);

        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.boxRightSearch.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.boxRightSearch = function(options){

        return this.each(function(){

            var bp = new $.boxRightSearch(this, options);

            $('div#' + options.boxRightId + ' input[name=' + options.searchInputName + ']').keyup(function() {
                bp.searchBox(this);
            });

        });

    };

})(jQuery);