angular.module('app')
    .directive("menu", function () {
        return {
            templateUrl: "public/web/directives/menu/html/index.html",
            replace: true,  // if true replace direactive element otherwise adding childNodes
            restrict: 'A', 
			transclude: true, //  when you want to create a directive that wraps  content. ng-transclude  attr use to wrap data in directive content
            scope: {
                title : "=menu",  // = means scope, @  means string, & means function  
                menus : "="
            },
            link: function (scope, element, attrs) {
				
            }
        }
    })
