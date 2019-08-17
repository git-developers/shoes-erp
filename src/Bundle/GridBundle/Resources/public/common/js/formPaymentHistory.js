(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formPaymentHistory = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;

        var apiContent = null;
        var modalMsgDiv = null;
        var modalMsgText = null;
        var modalRefresh = null;

        var msg_error = '<p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 3030)</p>';
        var msg_loading = '<div class="modal-body" align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formPaymentHistory', base);

        base.init = function(){
            var totalButtons = 0;
            // base.$el.append('<button name="public" style="'+base.options.buttonStyle+'">Private</button>');

            modal = $('#' + options.modalId);
            apiContent = modal.find('.crud-modal-content');
        };

        base.openModal = function(event, context) {
            // debug(e);
            // base.options.buttonPress.call( this );

            var id = $(context).parent().data('id');

            modal.find('small.label').html('Item ' + id);

            $.ajax({
                url: options.route,
                type: 'POST',
                dataType: 'html',
                data: {
                    id:id,
                    form_data:options.form_data
                },
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


        base.save = function(event) {
            event.preventDefault();

            modalMsgDiv = modal.find('div#message');
            modalMsgText = modal.find('div#message p');
            modalRefresh = modal.find('i.fa-refresh');

            var fields = $("form[name='" + options.formName + "']").serializeArray();

            $.ajax({
                url: options.route,
                type: 'POST',
                dataType: 'json',
                data: fields,
                beforeSend: function(jqXHR, settings) {
                    $('button[type="submit"]').prop('disabled', true);
                    modalMsgDiv.hide();
                    modalMsgText.empty();
                    modalRefresh.show();
                },
                success: function(data, textStatus, jqXHR) {

                    $('button[type="submit"]').prop('disabled', false);
                    modalRefresh.hide();

                    if (data.status) {
                        var row = options.dataTableObject.row('[data-id="' + data.id + '"]');
                        row.data(data.entity).draw();
                        modal.modal('hide');
                    } else {
                        var items = [];
                        $(data.errors).each(function(key, value) {
                            items.push($('<li/>').text(value));
                        });

                        modalMsgText.html(items);
                        modalMsgDiv.show();
                    }
                },
                error: function(jqXHR, exception) {
                    $('button[type="submit"]').prop('disabled', false);
                    modalMsgText.html(msg_error);
                    modalMsgDiv.show();
                    modalRefresh.hide();
                }
            });
        };

        base.discount = function(context) {

            var discount = parseFloat($(context).val().trim());
            var subtotal = parseFloat($("td.subtotal").text().trim());

            if (discount <= subtotal) {
                $("td.total").html((subtotal - discount).toFixed(2));
                $("td.discount").removeClass("bg-red").addClass("bg-gray-1");
            } else if (discount > subtotal) {
                $("td.total").html(subtotal);
                $("td.discount").removeClass("bg-gray-1").addClass("bg-red");
            }

            if (isNaN(discount)) {
                $("input[name='sales[discount]']").val("");
            } else {
                $("input[name='sales[discount]']").val(discount);
            }

            $("input[name='payment']").val("");
            $("input[name='sales[payment]']").val("");

            return false;
        };

        base.payment = function(context) {

            var payment = parseFloat($(context).val().trim());
            var pendingDebt = parseFloat($("span.pending-debt").text().trim());

            //console.log("payment.:: " + payment + " --- pendingDebt:: " + pendingDebt);

            if (payment > pendingDebt) {
                $("input[name='payment_history[changeBack]']").val((payment - pendingDebt).toFixed(2));
            } else if (isNaN(payment)) {
                $("input[name='payment_history[changeBack]']").val("");
            } else {
                $("input[name='payment_history[changeBack]']").val("");
            }

            return false;
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.formPaymentHistory = function(options) {

        return this.each(function() {

            var bp = new $.formPaymentHistory(this, options);
            
            $(document).on('click', 'td.' + options.modalId, function() {
                bp.openModal(event, this);
            });

            $(document).on('submit', "form[name='" + options.formName + "']" , function(event) {
                bp.save(event);
            });

            $(document).on("change paste keyup", "input[name='payment_history[payment]']", function() {
                bp.payment(this);
            });

        });
    };

})(jQuery);