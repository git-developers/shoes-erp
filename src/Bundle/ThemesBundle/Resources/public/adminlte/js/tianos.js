/**
* AdminLTE Demo Menu
* ------------------
* You should not use this file in production.
* This file is for demo purposes only.
*/
(function ($, AdminLTE) {

    "use strict";

    /**
    * List of all the available skins
    *
    * @type Array
    */
    var my_skins = [
        "skin-blue",
        "skin-black",
    ];

    setup();


    /**
    * Retrieve default settings and apply them to the template
    *
    * @returns void
    */
    function setup() {

        setTimeout(function() {
            $('div.tianos-alert-error').fadeOut('slow');
            $('div.tianos-alert-success').fadeOut('slow');
            $('div.tianos-alert-warning').fadeOut('slow');

        }, 2000);

    }
})(jQuery, $.AdminLTE);
