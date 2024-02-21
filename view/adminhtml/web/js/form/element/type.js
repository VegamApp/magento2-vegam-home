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
 
        initialize: function (){
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
                var categoryID = uiRegistry.get('index = category_id');
                const productid = $('#rh_grid_products');
                if (value == 2) {
                    categoryID.show();
                    productid.hide();
                } else if (value == 5) {
                    categoryID.hide();
                    productid.show();
                }
                else {
                    categoryID.hide();
                    productid.hide();
                }
            }, 500);
            return this;
        }
    });
});
