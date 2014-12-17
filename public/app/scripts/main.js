/*jshint unused: false, undef:false */

'use strict';

(function () {

    window.App = window.App || {
        Models: {},
        Collections: {},
        Views: {},
        Router: {}
    };

    window.template = function (id) {
        return Handlebars.compile($('#' + id).html());
    }

})();
