
// https://john-dugan.com/jquery-plugin-boilerplate-explained

;(function ( $, window, document, undefined ) {

    var pluginName = 'myPluginName';

    function Plugin ( element, options ) {

        this.element = element;
        this._name = pluginName;
        this._defaults = $.fn.myPluginName.defaults;
        this.options = $.extend( {}, this._defaults, options );
        this.init();
    }

    // Avoid Plugin.prototype conflicts
    $.extend(Plugin.prototype, {

        // Initialization logic
        init: function () {
            this.buildCache();
            this.bindEvents();
        },

        // Remove plugin instance completely
        destroy: function() {
            this.unbindEvents();
            this.$element.removeData();
        },

        // Cache DOM nodes for performance
        buildCache: function () {

            this.$element = $(this.element);
        },

        // Bind events that trigger methods
        bindEvents: function() {
            var plugin = this;
            plugin.$element.on('click'+'.'+plugin._name, function() {

                plugin.createArrayFiles.call(plugin);
                plugin.popFile.call(plugin);

                //jaferth
                //plugin.someOtherFunction.call(plugin);
            });
        },

        // Unbind events that trigger methods
        unbindEvents: function() {
            this.$element.off('.'+this._name);
        },

        // Create custom methods
        createArrayFiles: function() {
            var array = [];
            $('.file:checked').each(function(){
                array.push({
                    id: $(this).attr('id'),
                    value:  $(this).val()
                });
            });

            this.options.arrayFiles = array;
//                    this.callback();
        },

        // Create custom methods
        popFile: function() {
            var plugin = this;
            var files = this.options.arrayFiles;

//                    console.log('LENGHT :: ' + files.length);

            if(files.length > 0){
                this.options.file = files[0];
                plugin.saveFile.call(plugin);
            }

            this.callback();
        },

        // Create custom methods
        saveFile: function() {

            var plugin = this;
            var files = this.options.arrayFiles;
            var file = this.options.file;

            $.ajax({
                url: '{{ path(backend_googledrive_save) }}',
                type: 'POST',
                data: {
                    file:file
                },
                dataType: 'json',
                beforeSend: function() {
//                            console.log('beforeSend::: ');
                    plugin.options.icon = 'loading';
                    plugin.loadIcons.call(plugin);
                },
                success: function(data) {

                    console.dir('success::: ' + data.status + ' -- ' );

                    if(data.status == 'ok'){
                        plugin.options.icon = 'ok';
                        plugin.loadIcons.call(plugin);
                    }

                    var explode = function(){
                        plugin.options.arrayFiles = files.slice(1);
                        plugin.popFile.call(plugin);
                    };
                    setTimeout(explode, 1000);

                },
                error: function() {
                    plugin.options.icon = 'fail';
                    plugin.loadIcons.call(plugin);

                    var explode = function(){
                        plugin.options.arrayFiles = files.slice(1);
                        plugin.popFile.call(plugin);
                    };
                    setTimeout(explode, 600);

                }
            });

//                    this.callback();
        },

        // Create custom methods
        loadIcons: function() {
            var file = this.options.file;
            var icon = this.options.icon;

            $('#loading-' + file['id']).hide();
            $('#ok-' + file['id']).hide();
            $('#fail-' + file['id']).hide();
            $('#' + icon + '-' + file['id']).show();

        },

        callback: function() {
            // Cache onComplete option
            var onComplete = this.options.onComplete;

            if ( typeof onComplete === 'function' ) {
                onComplete.call(this.element);
            }
        }

    });

    $.fn.myPluginName = function ( options ) {
        this.each(function() {
            if ( !$.data( this, "plugin_" + pluginName ) ) {
                $.data( this, "plugin_" + pluginName, new Plugin( this, options ) );
            }
        });

        return this;
    };

    $.fn.myPluginName.defaults = {
        property: 'value',
        onComplete: null,
        arrayFiles: [],
        file: null,
        icon: 'loading',
    };

})( jQuery, window, document );

