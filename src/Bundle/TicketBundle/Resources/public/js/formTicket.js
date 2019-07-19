(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formTicket = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;

        var msg_error = '<tr><td colspan="5"><p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 6060)</p></td></tr>';
        var msg_loading = '<div align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formTicket', base);

        base.init = function(){
            var totalButtons = 0;

        };

        base.submit = function(event) {
            event.preventDefault();

            // var table = $('table.box-table-client tbody');
            var fields = $("form[name='" + options.formName + "']").serialize();

            console.dir("fields ::: " + fields);

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
                        $('div.tianos-alert-warning-2 span').html(data.message);
                        $('div.tianos-alert-warning-2').show();

                        setTimeout(function() {
                            $('div.tianos-alert-warning-2').fadeOut('slow');
                        }, 2000);
                    }

                },
                error: function(jqXHR, exception) {
                    console.log('ERROR');
                }
            });
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    // $.formTicket.defaultOptions = {
    //     buttonStyle: "border: 1px solid #fff; background-color:#000; color:#fff; padding:20px 50px",
    //     buttonPress: function () {}
    // };

    $.fn.formTicket = function(options){

        return this.each(function(){

            var bp = new $.formTicket(this, options);

            $(document).on('submit', "form[name='" + options.formName + "']" , function(event) {
                bp.submit(event);
            });

        });
    };

})(jQuery);