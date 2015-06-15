(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else {
        factory(jQuery);
    }
}(function ($) {

    var Swapselect = (function($) {

        /*
        * Constructor
         */
        function Swapselect( options ) {
            this.left = $('#swapSelect');
            this.right = $('#swapSelect_unlist');
            this.actions = {
                leftAll: $('#swapSelect_leftAll'),
                rightAll: $('#swapSelect_rightAll'),
                leftSelected: $('#swapSelect_leftSelected'),
                rightSelected: $('#swapSelect_rightSelected')
            };
            this.init();
        }

        Swapselect.prototype = {

            // Initialisation
            init: function() {
                this.action( this.actions );
            },

            // Actions
            action: function( actions ) {
                var self = this;

                /*
                * Double Click MoveToRight From Left
                 */
                self.left.on('dblclick', 'option', function() {
                    self.moveToRight(this);
                });

                /*
                 * Double Click MoveToLeft From Right
                 */
                self.right.on('dblclick', 'option', function() {
                    self.moveToLeft(this);
                });

                /*
                 * Button Action MoveToRight From Item Left Select
                 */
                actions.rightSelected.on('click', function() {

                    if ( self.left.find('option:selected') ) {
                        self.moveToRight(self.left.find('option:selected'));
                    }

                    $(this).blur();
                });

                /*
                * Button Action MoveToLeft From Item Right Select
                 */
                actions.leftSelected.on('click', function() {

                    if ( self.right.find('option:selected') ) {
                        self.moveToLeft(self.right.find('option:selected'));
                    }

                    $(this).blur();
                });

                /*
                 * Button Action MoveToRight From All Left
                 */
                actions.rightAll.on('click', function() {

                    if ( self.left.find('option') ) {
                        self.moveToRight(self.left.find('option'));
                    }

                    $(this).blur();
                });

                /*
                 * Button Action MoveToLeft From All Right
                 */
                actions.leftAll.on('click', function() {

                    if ( self.right.find('option') ) {
                        self.moveToLeft(self.right.find('option'));
                    }

                    $(this).blur();
                });
            },

            /*
            * Function MoveToRight
             */
            moveToRight: function( data, event) {
                this.right.append(data);
                return this;
            },

            /*
             * Function MoveToLeft
             */
            moveToLeft: function( data, event) {
                this.left.append(data);
                return this;
            }
        }

        return Swapselect;
    })($);

    $.fn.swapselect = function() {
        return this.each(function() {
            return new Swapselect(this);
        });
    };
}));