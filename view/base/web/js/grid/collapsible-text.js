/**
 * Copyright 2018 aheadWorks. All rights reserved.
 * See LICENSE.txt for license details.
 */

define([
    'jquery',
    'collapsible',
    'Magento_Ui/js/grid/columns/column'
], function ($, Collapsible, Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'Phong_ApiLogger/grid/collapsible-text',
            title: 'Show/Hide',
        },

        getTitle: function () {
            return this.title;
        },

        focused: function () {
            return true;
        }
    });
});
