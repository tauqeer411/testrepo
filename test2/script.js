var app = angular.module('myApp', []);

function myController($scope) {
    $scope.isDraggable = true;
}


app.directive('myPopup', [
    function () {
        "use strict";

        return {
            restrict: 'E',
            replace: true,
            transclude: true,
            template: '<div my-draggable="draggable" enabled="{{draggable}}" class="dialog"><div class="title">{{title}}</div><div class="content" ng-transclude></div></div>',
            scope: {
                title: '@?dialogTitle',
                draggable: '@?isDraggable',
                width: '@?width',
                height: '@?height',
            },
            controller: function ($scope) {
                // Some code
            },
            link: function (scope, element, attr) {
                if (scope.width) {
                    element.css('width', scope.width);
                }

                if (scope.height) {
                    element.css('height', scope.height);
                }                    
            }
        };
    }
]);

app.directive('myDraggable', ['$document',
    function ($document) {
    return {
        restrict: 'A',
        replace: false,

        link: function (scope, elm, attrs) {
            var startX, startY, initialMouseX, initialMouseY;
            
            if (attrs.enabled == "true") {
                elm.bind('mousedown', function ($event) {
                    startX = elm.prop('offsetLeft');
                    startY = elm.prop('offsetTop');
                    initialMouseX = $event.clientX;
                    initialMouseY = $event.clientY;
                    $document.bind('mousemove', mousemove);
                    $document.bind('mouseup', mouseup);
                    $event.preventDefault();
                });
            }

            function getMaxPos() {
                var computetStyle = getComputedStyle(elm[0], null);
                var tx, ty;
                var transformOrigin =
                    computetStyle.transformOrigin ||
                    computetStyle.webkitTransformOrigin ||
                    computetStyle.MozTransformOrigin ||
                    computetStyle.msTransformOrigin ||
                    computetStyle.OTransformOrigin;
                tx = Math.ceil(parseFloat(transformOrigin));
                ty = Math.ceil(parseFloat(transformOrigin.split(" ")[1]));
                return {
                    max: {
                        x: tx + window.innerWidth - elm.prop('offsetWidth'),
                        y: ty + window.innerHeight - elm.prop('offsetHeight')
                    },
                    min: {
                        x: tx,
                        y: ty
                    }
                };
            }

            function mousemove($event) {
                var x = startX + $event.clientX - initialMouseX;
                var y = startY + $event.clientY - initialMouseY;
                var limit = getMaxPos();
                x = (x < limit.max.x) ? ((x > limit.min.x) ? x : limit.min.x) : limit.max.x;
                y = (y < limit.max.y) ? ((y > limit.min.y) ? y : limit.min.y) : limit.max.y;
                elm.css({
                    top: y + 'px',
                    left: x + 'px'
                });
                $event.preventDefault();
            }

            function mouseup() {
                $document.unbind('mousemove', mousemove);
                $document.unbind('mouseup', mouseup);
            }
        }
    };
}]);