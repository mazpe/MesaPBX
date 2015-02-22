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

app.run(function($rootScope, $location, AuthenticationService) {
    var routesThatRequireAuth = ['/home'];
    $rootScope.$on('$routeChangeStart', function(event, next, current) {
        // underscore .contains
        if (_(routesThatRequireAuth).contains($location.path()) && !AuthenticationService.isLoggedIn()) {
            $location.path('/login');
        }
    });
});

app.factory("UserService", function($http) {
    return {
        get: function() {
            return $http.get('/get-users');
        }
    };
});

app.factory("SessionService", function() {
    return {
        get: function(key) {
            sessionStorage.getItem(key);
        },
        set: function(key,val) {
            sessionStorage.setItem(key,val);
        },
        unset: function(key) {
            sessionStorage.removeItem(key);
        }
    };
});

app.factory("AuthenticationService", function($http, $location, SessionService) {
    var cacheSession = function() {
        SessionService.set('authenticated', true);
    };
    var uncacheSession = function() {
        SessionService.unset('authenticated');
    };
    return {
        login: function(credentials) {
            var login = $http.post("/login", credentials);
            login.success(cacheSession);
        },
        logout: function() {
            var logout = $http.get("/logout");
            logout.success(uncacheSession);
        },
        isLoggedIn: function() {
            return SessionService.get('authenticated');
        }
    }
});

app.controller("LoginController", function($scope, $location, AuthenticationService) {
    $scope.credentials = { email: "", password: ""};
    $scope.login = function() {
        AuthenticationService.login($scope.credentials).success(function() {
            $location.path('/home');
        });
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