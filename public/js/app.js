var app = angular.module('app', ['ngRoute']);
app.config(function($routeProvider) {
    $routeProvider.when('/login', {
        templateUrl: 'templates/login.html',
        controller: 'LoginController'
    });

    $routeProvider.when('/home', {
       templateUrl: 'templates/home.html',
        controller: 'HomeController'
    });

    $routeProvider.when('/users', {
        templateUrl: 'templates/users.html',
        controller: 'UsersController'
    });

    $routeProvider.when('/extensions', {
        templateUrl: 'templates/extensions.html',
        controller: 'ExtensionsController'
    });

    $routeProvider.otherwise( { redirectTo: '/login' });
});

app.factory("UserService", function($http) {
    return {
        get: function() {
            return $http.get('/get-users');
        }
    };
});

app.factory("AuthenticationService", function($http, $location) {
    return {
        login: function(credentials) {
            return $http.post("/auth/login", credentials);
        },
        logout: function() {
            return $http.get("/auth/logout");
        }
    }
});

app.controller("LoginController", function($scope, AuthenticationService) {
    $scope.credentials = { username: "", password: ""};
    $scope.login = function() {
        AuthenticationService.login($scope.credentials);
    };
});

app.controller("HomeController", function($scope) {
    $scope.title = "Home";
    $scope.message = "This is a message";
});

app.controller("UsersController", function() {

});

app.controller("ExtensionsController", function() {

});