(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formOrders = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        var msg_error = '<tr><td colspan="5"><p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 6060)</p></td></tr>';
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';
        var msg_default = '<i class="icon fa fa-info"></i> Información.';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formOrders', base);

        base.init = function(){
            var totalButtons = 0;
        };

        base.validate = function() {

            var msg;
            var errors = 0;
            var message = $('div.ticket-message');
            var fields = $("form[name='" + options.formName + "']").serializeArray();

            $.each(fields, function(i, field) {

                if (field.value != "" || $.inArray(field.name, ["orders[name]", "orders[client]", "discount", "sales[discount]", "orders[paymentType]"]) !== -1) {
                    return true;
                }

                console.dir(field);

                errors++;

                switch(field.name) {
                    case "orders[deliveryDate]":
                        msg = 'Seleccione la Fecha de entrega.';
                        break;
                    case "payment":
                        msg = 'Ingrese pago del cliente.';
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
                    $("button[name='orders[submit]']").attr("disabled", true);
                },
                success: function(data, textStatus, jqXHR) {

                    if (data.status) {
                        window.location.href = options.routeRedirect;
                    } else {

                        $("button[name='orders[submit]']").attr("disabled", false);

                        message.find('p').html(data.message);
                        message.removeClass("callout-primary").addClass("callout-warning");

                        setTimeout(function() {
                            message.removeClass("callout-warning").addClass("callout-primary");
                            message.find('p').html(msg_default);
                        }, 3000);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log('ERROR');
                    $("button[name='orders[submit]']").attr("disabled", false);
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

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.formOrders = function(options){

        return this.each(function(){

            var bp = new $.formOrders(this, options);

            $("form[name='" + options.formName + "']").submit(function(event) {
                event.preventDefault();

                // bp.submit(event);

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