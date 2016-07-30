angular.module('app', ['ui.router'])

    .config(['$stateProvider', '$urlRouterProvider',
        function ($stateProvider, $urlRouterProvider) {

            $urlRouterProvider.otherwise('/');

            $stateProvider.state('auth', {
                'abstract': true,
                resolve: {
                    authorize: ['authorization',
                        function (authorization) {
                            return authorization.authorize();
                        }
                    ]
                }
            }).state('home', {
                parent: 'auth',
                url: '/',
                data: {
                    roles: ['user']
                },
                views: {
                    'content@': {
                        templateUrl: 'web/modules/home/html/index.html',
                        controller: 'app.home.index'
                    }
                }
            }).state('signin', {
                parent: 'auth',
                url: '/signin',
                data: {
                    roles: []
                },
                views: {
                    'content@': {
                        templateUrl: 'web/modules/auth/html/index.html',
                        controller: 'app.auth.index'
                    }
                }
            }).state('restricted', {
                parent: 'auth',
                url: '/restricted',
                data: {
                    roles: ['admin']
                },
                views: {
                    'content@': {
                        templateUrl: 'public/restricted.html'
                    }
                }
            }).state('accessdenied', {
                parent: 'auth',
                url: '/denied',
                data: {
                    roles: []
                },
                views: {
                    'content@': {
                        templateUrl: 'public/denied.html'
                    }
                }
            });
        }
    ])

    .run(['$rootScope', '$state', '$stateParams', 'authorization', 'principal',
        function ($rootScope, $state, $stateParams, authorization, principal) {
            $rootScope.$on('$stateChangeStart', function (event, toState, toStateParams) {
                $rootScope.toState = toState;
                $rootScope.toStateParams = toStateParams;

                if (principal.isIdentityResolved()) authorization.authorize();
            });
        }
    ])

    /* main app controller */
    .controller('app.controller.main', ['$scope', '$state', 'principal',
        function ($scope, $state, principal) {

            $scope.principal = principal;
            $scope.signout = function () {
                principal.authenticate(null);
                $state.go('signin');
            };
        }
    ])