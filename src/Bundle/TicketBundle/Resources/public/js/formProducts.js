(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formProducts = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;

        var apiContent = null;

        var msg_error = '<tr><td colspan="5"><p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 6060)</p></td></tr>';
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formProducts', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modalId);
            apiContent = modal.find('div.modal-content');
        };

        base.increment = function(context) {

            var div = $('div.box-table-items div.items');
            var idItem = $(context).data('id-item');

            $.ajax({
                url: options.routeIncrement,
                type: 'POST',
                dataType: 'html',
                data: {
                    idItem: idItem,
                    action: 'INCREMENT'
                },
                beforeSend: function(jqXHR, settings) {
                    $("input[name='sales[discount]']").val("");
                },
                success: function(data, textStatus, jqXHR) {
                    div.html(data);
                },
                error: function(jqXHR, exception) {
                    div.html(msg_error);
                }
            });
        };

        base.decrement = function(context) {

            var div = $('div.box-table-items div.items');
            var idItem = $(context).data('id-item');

            $.ajax({
                url: options.routeDecrement,
                type: 'POST',
                dataType: 'html',
                data: {
                    idItem: idItem,
                    action: 'DECREMENT'
                },
                beforeSend: function(jqXHR, settings) {
                    $("input[name='sales[discount]']").val("");
                },
                success: function(data, textStatus, jqXHR) {
                    div.html(data);
                },
                error: function(jqXHR, exception) {
                    div.html(msg_error);
                }
            });
        };

        base.removeAll = function(context) {

            if (!confirm('Esta seguro?')) {
                return false;
            }

            var div = $('div.box-table-items div.items');

            $.ajax({
                url: options.routeRemoveAll,
                type: 'POST',
                dataType: 'html',
                data: {},
                beforeSend: function(jqXHR, settings) {
                    $("input[name='sales[discount]']").val("");
                    div.html('<p><i class="fa fa-fw fa-info-circle"></i> Agregue servicios.</p>');
                },
                success: function(data, textStatus, jqXHR) {

                },
                error: function(jqXHR, exception) {
                    div.html(msg_error);
                }
            });
        };

        base.selectCategoryTicket = function(context) {

            var idCategory = $(context).data('category');

            $('span.li-span').removeClass('bg-gray');
            $('span.li-span-' + idCategory).addClass('bg-gray');

            $('table.products > tbody > .tr-product').hide();
            $('table.products > tbody > .tr-product-' + idCategory).show();
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.formProducts = function(options){

        return this.each(function(){

            var bp = new $.formProducts(this, options);

            $(document).on('click', 'li.category-ticket', function(event) {
                event.stopPropagation();
                bp.selectCategoryTicket(this);
            });

            $(document).on('click', 'button.increment', function(event) {
                bp.increment(this);
            });

            $(document).on('click', 'button.decrement', function(event) {
                bp.decrement(this);
            });

            $('span.remove-all').click(function() {
                bp.removeAll(this);
            });

        });
    };

})(jQuery);