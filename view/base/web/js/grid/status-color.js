/**
 * Copyright 2018 aheadWorks. All rights reserved.
 * See LICENSE.txt for license details.
 */

define([
    'jquery',
    'Magento_Ui/js/grid/columns/column'
], function ($, Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'Phong_ApiLogger/grid/status-color',
            success: 'green',
            fail: 'red'
        },

        getBackGroundColor: function (row) {
            var color = 'white';
            switch (this.getLabel(row)) {
                case 'OK':
                     color = this.success;
                    break;
                case 'KO':
                     color = this.fail;
                    break;
                default:
                     color = "white";
            }

            return color;
        }
    });
});
