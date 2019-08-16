(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formPointOfSale = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;

        var apiContent = null;
        var modalMsgDiv = null;
        var modalMsgText = null;
        var modalRefresh = null;

        var msg_error = '<tr><td colspan="5"><p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 5050)</p></td></tr>';
        var msg_loading = '<tr><td colspan="5" align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></td></tr>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formPointOfSale', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modalId);
            apiContent = modal.find('div.modal-content');
        };

        base.openModal = function(event, context) {

            $.ajax({
                url: options.route,
                type: 'PUT',
                dataType: 'html',
                data: {},
                beforeSend: function(jqXHR, settings) {
                    apiContent.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    apiContent.html(data);
                },
                error: function(jqXHR, exception) {
                    apiContent.html(msg_error);
                }
            });
        };

        base.submit = function(event) {
            event.preventDefault();

            var table = $('table.box-table-pdv tbody');
            var clientId = $("input[name='pdv[code]']:checked").val();
            var fields = $("form[name='" + options.formName + "']").serialize();

            $.ajax({
                url: options.route,
                type: 'POST',
                dataType: 'html',
                data: fields,
                beforeSend: function(jqXHR, settings) {
                    table.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    table.html(data);

                    $('select[name="' + options.clientId + '"]').val(clientId);
                    $('div#modal-create-pdv').modal('hide');
                },
                error: function(jqXHR, exception) {
                    table.html(msg_error);
                }
            });
        };

        base.removeClient = function(context) {

            if (confirm('Esta seguro?')) {
                $(context).parents('tr').remove();

                $('select[name="' + options.clientId + '"]').val('');
                $('table.box-table-client tbody').html('<tr><td colspan="5">Seleccione un pdv 33.</td></tr>');
            }

            return false;
        };

        base.searchClient = function(context) {

            var index = 0;
            var filter = $(context).val().toUpperCase();

            $('table.table-pdv tbody tr').each(function (i, row) {

                $(row).hide();
                var td = $(row).find('td:eq(3)').html().trim().toUpperCase();

                if (td != '' && (td.indexOf(filter) > -1)) {
                    $(row).show();
                    index++;
                }
            });

            $('span.total-pdv').html(index);
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.formPointOfSale = function(options){

        return this.each(function(){

            var bp = new $.formPointOfSale(this, options);

            $(document).on('click', 'span.add-pdv', function(event) {
                bp.openModal(event, this);
            });

            $(document).on('click', 'button.btn-remove-pdv', function() {
                bp.removeClient(this);
            });

            $(document).on('keyup', 'input:text.search-pdv', function() {
                bp.searchClient(this);
            });

            $(document).on('submit', "form[name='" + options.formName + "']" , function(event) {
                bp.submit(event);
            });

        });
    };

})(jQuery);