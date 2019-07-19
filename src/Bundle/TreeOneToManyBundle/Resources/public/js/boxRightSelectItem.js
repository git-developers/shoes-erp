(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.boxRightSelectItem = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var DELAY = 800;
        var base = this;
        var boxLeft = null;
        var boxRight = null;
        var globalTimeout = null;
        var msg_default = '<p><i class="fa fa-fw fa-info"></i> Seleccione un item.</p>';
        var msg_error = '<i class="fa fa-fw fa-warning"></i> Seleccion derecha Error: reintentar';
        var msg_assign_error = '<i class="fa fa-fw fa-warning"></i> Error al asignar items.';
        var msgBoxleftNotValue = '<i class="fa fa-fw fa-warning"></i> Tiene que seleccionar un item de la izquierda.';
        var error_boxleft_not_value = 'box_left_no_value';

        base.$el = $(el);
        base.el = el;
        base.$el.data('boxRightSelectItem', base);

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

        base.selectItem = function(context) {
            // debug(e);
            // base.options.buttonPress.call( this );


            /* ****CHECKBOX TOOGLE **** */
            /*
            var checkboxRight = $(context).find('input[type=checkbox]');

            if(checkboxRight.is(':checked')){
                checkboxRight.prop('checked', false);
            }else{
                checkboxRight.prop('checked', true);
            }

            /* ****CHECKBOX TOOGLE **** */



            var checkboxAll = boxRight.find('input[type=checkbox]');
            var boxLeftValue = $('#' + options.boxLeftId + ' input[name=' + options.boxLeftLiInputName + ']:checked').val();

            var boxRightValues = $('#' + options.boxRightId + ' input:checkbox:checked').map(function() {
                return this.value;
            }).get();

            if(globalTimeout != null){
                clearTimeout(globalTimeout);
            }

            globalTimeout = setTimeout(function() {

                $.ajax({
                    url: options.routeSelectItem,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        boxLeftValue:boxLeftValue,
                        boxRightValues:boxRightValues
                    },
                    cache: true,
                    beforeSend: function(jqXHR, settings) {
                        boxRight.find('i.fa-refresh').show();
                    },
                    success: function(data, textStatus, jqXHR) {
                        boxRight.find('i.fa-refresh').hide();

                        if(data.status){

                            base.addClassCallout('success');
                            base.setMessageCallout('<p><i class="fa fa-fw fa-thumbs-up"></i> Exito: <span class="badge bg-green-active">' + boxLeftValue + '</span></p>');

                            setTimeout(function(){
                                base.setMessageCallout(msg_default)
                            }, 800);

                        }else{
                            base.addClassCallout('danger');
                            checkboxAll.prop('checked', false);
                            // boxRight.find('li').removeClass(options.liClass);
                        }
                    },
                    error: function(jqXHR, exception) {
                        base.addClassCallout('danger');
                        base.setMessageCallout(msg_error);
                        boxRight.find('i.fa-refresh').hide();
                    }
                });

            }, DELAY);
        };

        base.isValid = function(event) {

            if (!$('input[type=radio]:checked').val()) {
                base.addClassCallout('danger');
                base.setMessageCallout(msgBoxleftNotValue);

                event.preventDefault();

                return false;
            }

            return true;
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.boxRightSelectItem = function(options){

        return this.each(function(){

            var bp = new $.boxRightSelectItem(this, options);

            $(document).on('click', 'li.' + options.liClass, function(event) {

                var isValid = bp.isValid(event);

                if(isValid){
                    bp.selectItem(this);
                }
            });
        });
    };

})(jQuery);