/**
 * @package Vegam_Homepage
 */
define([
    'jquery',
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select'
], function ($, _, uiRegistry, select) {
    'use strict';
    return select.extend({

        initialize: function () {
            var status = this._super().initialValue;
            this.fieldDepend(status);
            return this;
        },


        /**
         * On value change handler.
         *
         * @param {String} value
         */
        onUpdate: function (value) {

            this.fieldDepend(value);
            return this._super();
        },

        /**
         * Update field dependency
         *
         * @param {String} value
         */
        fieldDepend: function (value) {
            setTimeout(function () {
                if (value == '') {
                    $(".banner").hide();
                    $(".banner_title").hide();
                }
                if (value == 'with_title') {
                    $(".banner_title").show();
                    $(".banner").hide();
                }
                if (value == 'without_title') {
                    $(".banner").show();
                    $(".banner_title").hide();
                }
            }, 500);
            return this;
        }
    });
});
