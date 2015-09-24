var Subpages = (function ($) {
    
    'use strict';

    function Subpages() {
        // Dom is ready
        $(function () {

            // add all our events
            this.addEvents();

        }.bind(this));
    }

    Subpages.prototype.addEvents = function () {
        $('.sort-btn').on('click', function (e) {
            // remove all events, since dom will be updated
            $('.sort-btn').off('click');
            $('.show-btn').off('click');

            // get array of elements
            this.elements = $(e.target).parent('.list').children('.sortable-elements').children('li');

            // get order
            var order = $(e.target).data('order');

            // sort them
            this.sortElements(this.elements, order);
        }.bind(this));
        
        $('.show-btn').on('click', function (e) {
            // toggle visibility of elements
            $(e.target).parent('.list').children('.sortable-elements').toggle();
        }.bind(this));
    };

    Subpages.prototype.sortElements = function (element, order) {

        // set default order if not set as param
        order = order ? order : 'asc';

        // sort the elements based on its text content
        element.sort(function (a, b) {

            var aList, bList;

            a = $(a).text();
            b = $(b).text();

            if (order === 'asc') {
                if (isNaN(a) || isNaN(b)) {
                    if (a > b) return 1;
                    else return -1;
                }
                return a - b;
            } else {
                if (isNaN(a) || isNaN(b)) {
                    if (b > a) return 1;
                    else return -1;
                }
                return b - a;
            }
        });

        // put sorted results back on page
        $(element).parent().html(element);
        // since dom is update we must add all events again
        this.addEvents();
    }

    return new Subpages();
}(jQuery));