(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formSales = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        var msg_error = '<tr><td colspan="5"><p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 6060)</p></td></tr>';
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';
        var msg_default = '<i class="icon fa fa-info"></i> Información.';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formSales', base);

        base.init = function(){
            var totalButtons = 0;
        };

        base.validate = function() {

            var msg;
            var errors = 0;
            var message = $('div.ticket-message');
            var fields = $("form[name='" + options.formName + "']").serializeArray();

            $.each(fields, function(i, field) {

                if (field.value != "" || field.name == "sales[name]") {
                    return true;
                }

                errors++;

                switch(field.name) {
                    case "sales[client]":
                        msg = 'Seleccione un cliente.';
                        break;
                    case "sales[paymentType]":
                        msg = 'Seleccione un tipo de pago.';
                        break;
                        break;
                    case "sales[deliveryDate]":
                        msg = 'Fecha de entrega.';
                        break;
                }

                message.find('p').html('<i class="icon fa fa-warning"></i> ' + msg);
                message.removeClass("callout-primary").addClass("callout-warning");

                setTimeout(function() {
                    message.removeClass("callout-warning").addClass("callout-primary");
                    message.find('p').html(msg_default);
                }, 2000);

            });

            return errors;
        }

        base.submit = function(event) {

            var message = $('div.ticket-message');
            var fields = $("form[name='" + options.formName + "']").serialize();

            $.ajax({
                url: options.route,
                type: 'POST',
                dataType: 'json',
                data: fields,
                beforeSend: function(jqXHR, settings) {

                },
                success: function(data, textStatus, jqXHR) {

                    if (data.status) {
                        window.location.href = options.routeRedirect;
                    } else {
                        message.find('p').html(data.message);
                        message.removeClass("callout-primary").addClass("callout-warning");

                        setTimeout(function() {
                            message.removeClass("callout-warning").addClass("callout-primary");
                            message.find('p').html(msg_default);
                        }, 2000);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log('ERROR');
                }
            });
        };

        base.productThumbnail = function(context) {

            var image = new Image();
            image.src = $(context).data("thumb") + '?' + Math.random();
            image.onload = function () {
                $('div.box-thumbnail').empty().append(image);
            };

            image.onerror = function () {
                $('div.box-thumbnail').empty().html('That image is not available.');
            };

            $('div.box-thumbnail').empty().html('Loading...');

            return false;
        };

        base.discount = function(context) {

            var discount = parseFloat($(context).val());
            var subtotal = parseFloat($("td.subtotal").text().trim());

            if (discount <= subtotal) {
                $("input[name='sales[discount]']").val(discount);
                $("td.total").html((subtotal - discount).toFixed(2));
                $("td.discount").removeClass("bg-red").addClass("bg-gray-1");
            } else if (discount > subtotal) {
                $("td.total").html(subtotal);
                $("td.discount").removeClass("bg-gray-1").addClass("bg-red");
            } else if (isNaN(discount)) {
                $("input[name='sales[discount]']").val("");
            }

            return false;
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.formSales = function(options){

        return this.each(function(){

            var bp = new $.formSales(this, options);

            $("form[name='" + options.formName + "']").submit(function(event) {
                event.preventDefault();

                var validate = bp.validate();

                if (validate <= 0) {
                    bp.submit(event);
                }

            });

            $("img.product-thumbnail").click(function(event) {
                bp.productThumbnail(this);
            });

            $('#modal-product-thumbnail').on('hidden.bs.modal', function () {
                $('div.box-thumbnail').empty().html('');
            });

            $(document).on("change paste keyup", "input[name=discount]", function() {
                bp.discount(this);
            });

        });
    };

})(jQuery);