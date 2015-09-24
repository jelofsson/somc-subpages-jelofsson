var Subpages = (function ($) {

    function Subpages() {
        // Dom is ready
        $(function () {

            // Add all our events
            this.addEvents();

        }.bind(this));
    }

    Subpages.prototype.addEvents = function () {
        $('.sort-btn').on('click', function (e) {
            // Remove all events, since dom will be updated
            $('.sort-btn').off('click');
            $('.show-btn').off('click');

            // Get array of elements
            this.elements = $(e.target).parent('.list').children('.sortable-elements').children('li');

            // Get order
            var order = $(e.target).data('order');

            // Sort them
            this.sortElements(this.elements, order);
        }.bind(this));
        
        $('.show-btn').on('click', function(e) {
            // Toggle visibility of elements
            $(e.target).parent('.list').children('.sortable-elements').toggle();
        });
    }

    Subpages.prototype.sortElements = function (element, order) {

        // Set default order if not set as param
        order = order ? order : 'asc';

        // Sort the elements based on its text content
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

        // Put sorted results back on page
        $(element).parent().html(element);
        // Since dom is update we must add all events again
        this.addEvents();
    }

    return new Subpages();
}(jQuery));