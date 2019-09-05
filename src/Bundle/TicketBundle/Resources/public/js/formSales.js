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

                if (field.value != "" || $.inArray(field.name, ["sales[name]", "discount", "sales[discount]"]) !== -1) {
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
                    case "sales[deliveryDate]":
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
                    $("button[name='sales[submit]']").attr("disabled", true);
                },
                success: function(data, textStatus, jqXHR) {

                    if (data.status) {
                        window.location.href = options.routeRedirect;
                    } else {

                        $("button[name='sales[submit]']").attr("disabled", false);

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
                    $("button[name='sales[submit]']").attr("disabled", false);
                }
            });
        };

        base.productThumbnail = function(context) {

            var box = $('div.box-thumbnail');

            var image = new Image();
            image.src = $(context).data("thumb") + '?' + Math.random();
            image.onload = function () {
                box.empty().append(image);
            };

            image.onerror = function () {
                box.empty().html('That image is not available.');
            };

            box.empty().html('Loading...');

            return false;
        };

        base.productDetail = function(context) {

            var id = $(context).parent().data('id');
            var box = $('div.box-product-detail');

            $.ajax({
                url: options.routeProductView,
                type: 'POST',
                dataType: 'html',
                data: {
                    id:id
                },
                beforeSend: function(jqXHR, settings) {
                    box.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    box.html(data);
                },
                error: function(jqXHR, exception) {
                    box.html(msg_error);
                }
            });

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

        base.payment = function(context) {

            var payment = parseFloat($(context).val().trim());
            var total = parseFloat($("td.total").text().trim());

            if (payment > total) {
                $("td.change").html((payment - total).toFixed(2));
            } else if (payment < total || isNaN(payment)) {
                $("td.change").html("0.0");
            }

            if (isNaN(payment)) {
                $("input[name='sales[payment]']").val("");
            } else {
                $("input[name='sales[payment]']").val(payment);
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

            $("td.product-detail").click(function(event) {
                bp.productDetail(this);
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

            $(document).on("change paste keyup", "input[name=payment]", function() {
                bp.payment(this);
            });

        });
    };

})(jQuery);