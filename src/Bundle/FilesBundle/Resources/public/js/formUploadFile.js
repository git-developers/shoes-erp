(function($) {
    "use strict";

    // Global Variables
    var MAX_HEIGHT = 100;

    $.formUploadFile = function(el, options) {

        // Global Private Variables
        var MAX_WIDTH = 200;
        var base = this;
        var modal = null;

        var progress = null;
        var inputFile = null;
        var apiContent = null;
        var buttonSubmit = null;
        var modalBoxError = null;
        var modalBoxUpload = null;
        var modalBoxSuccess = null;

        var msg_error = '<p>INFO: Oops!, no se completo el proceso. Contacte a su proveedor (code 3030)</p>';
        var msg_loading = '<div class="modal-body" align="center"><i class="fa fa-2x fa-refresh fa-spin"></i></div>';

        base.$el = $(el);
        base.el = el;
        base.$el.data('formUploadFile', base);

        base.init = function(){
            var totalButtons = 0;

            modal = $('#' + options.modalId);
            apiContent = modal.find('.crud-modal-content');
            buttonSubmit = $('button[type="submit"]');
        };

        base.openModal = function(event, context) {

            var id = $(context).parent().data('id');

            modal.find('small.label').html('Item ' + id);

            $.ajax({
                url: options.routeModal,
                type: 'PUT',
                dataType: 'html',
                cache: true,
                data: {
                    id: id,
                    filter: options.filter,
                    fileType: options.fileType,
                    form_data: options.form_data,
                    className: options.className
                },
                beforeSend: function(jqXHR, settings) {
                    buttonSubmit.prop('disabled', true);
                    apiContent.html(msg_loading);
                },
                success: function(data, textStatus, jqXHR) {
                    buttonSubmit.prop('disabled', false);
                    apiContent.html(data);
                },
                error: function(jqXHR, exception) {
                    apiContent.html(msg_error);
                }
            });

        };

        base.upload = function(event, context) {
            event.preventDefault();

            var mb1 = 1048576; // 1MB
            var mb5 = 5242880; // 5MB
            var id = $('input[name="id"]').val();
            var file = $('input[type="file"]').get(0).files[0];

            progress = $('div.progress-bar');
            inputFile = $('input[type=file]');
            buttonSubmit = $('button[type="submit"]');

            modalBoxUpload = modal.find('div.box-upload');
            modalBoxSuccess = modal.find('div.box-success');
            modalBoxError = modal.find('div.box-error');

            if (file != null && typeof file != "undefined" && file.size > mb5) {
                console.log("size ::: " + file.size);

                modalBoxError.show();
                modalBoxError.find('span').html('El archivo supera los 5mb.');

                return false;
            }

            $(context).ajaxSubmit({
                url: options.routeCreate,
                type: 'POST',
                dataType: 'json',
                target: 'div.target-result',
                data: {
                    id: id,
                    filter: options.filter,
                    className: options.className,
                    fileType: options.fileType
                },
                beforeSubmit: function(arr, $form, options) {
                    modalBoxUpload.show();
                    modalBoxSuccess.hide();
                    modalBoxError.hide();
                    modalBoxError.find('span').html('');

                    progress.width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    progress.width(percentComplete + '%');
                    progress.html('<span>' + percentComplete +' %</span>');
                },
                error:function (data) {

                    var message = 'Volver a intentar (007).';

                    if (data.status == 413) {
                        message = 'El archivo tiene un tamaño mayor a los esperado.';
                    }

                    progress.width('0%');
                    progress.html('');
                    inputFile.val('');

                    modalBoxUpload.show();
                    modalBoxSuccess.hide();
                    modalBoxError.show();
                    modalBoxError.find('span').html(message);
                },
                success:function (response, statusText, xhr, $form) {

                    if (response.status) {

                        modalBoxUpload.hide();
                        modalBoxSuccess.show();
                        modalBoxError.hide();

                        /**
                         * @type {HTMLImageElement}
                         */
                        var img = new Image();
                        $(img).one('load', function() {
                            console.log(this.width + 'x' + this.height);
                        });
                        img.src = response.imagePath;
                        $(img).appendTo('div.box-success div.img');
                        /**
                         * end
                         */


                        /**
                         * @table tr
                         */
                        $("tr#" + id + " td:nth-child(2)").empty();
                        var img2 = new Image();
                        $(img2).one('load', function() {
                            //console.log(this.width + 'x' + this.height);
                        });
                        img2.src = response.imagePath;
                        $(img2).addClass("img-circle img-thumbnail");
                        $(img2).appendTo("tr#" + id + " td:nth-child(2)");
                        /**
                         * end
                         */

                        buttonSubmit.prop('disabled', true);

                    } else {
                        inputFile.attr('value', '');
                        modalBoxUpload.show();
                        modalBoxSuccess.hide();
                        modalBoxError.show();
                        modalBoxError.find('span').html(response.message);
                    }

                },
                resetForm: true
            });

            return false;
        };

        // Private Functions
        function debug(e) {
            console.log(e);
        }

        base.init();
    };

    $.fn.formUploadFile = function(options){

        return this.each(function(){

            var bp = new $.formUploadFile(this, options);

            $(document).on('click', 'td.' + options.modalId, function() {
                bp.openModal(event, this);
            });

            $(document).on('submit', "form[name='" + options.formName + "']" , function(event) {
                bp.upload(event, this);
            });

        });
    };

})(jQuery);