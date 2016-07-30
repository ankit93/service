angular.module('app')
.controller('app.auth.index', ['$scope', '$state', 'principal', function($scope, $state, principal) {
    $scope.signin = function() {

        
        if($scope.form.username == "admin" && $scope.form.password == '123' ){
            principal.authenticate({
                name: 'Test User',
                roles: ['user']
            });
            if ($scope.returnToState)
                $state.go($scope.returnToState.name, $scope.returnToStateParams);
            else $state.go('home');
        }
        else{
            alert("Username or password not match");
        }




    };
}
])