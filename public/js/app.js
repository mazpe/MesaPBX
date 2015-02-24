var app = angular.module('app', ['ngRoute', 'smart-table']);

app.config(function($routeProvider) {
    $routeProvider.when('/login', {
        templateUrl: 'templates/login.html',
        controller: 'LoginController'
    });

    $routeProvider.when('/home', {
       templateUrl: 'templates/home.html',
        controller: 'HomeController',
        resolve: {
            "expiry" : function ($http) {
                return $http.get('/expiry');
            }
        }
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

// handle session timing out on the server side
app.config(function($httpProvider) {

    var logsOutUserOn401 = function($location, $q, SessionService, FlashService) {
        var success = function(response) {
            return response;
        };

        var error = function(response) {
            if(response.status === 401) {
                SessionService.unset('authenticated');
                $location.path('/login');
                FlashService.show(response.data.flash);
            }
            return $q.reject(response);
        };

        return function(promise) {
            return promise.then(success, error);
        };
    };

    $httpProvider.interceptors.push(logsOutUserOn401);
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

app.factory("FlashService", function($rootScope) {
    return {
        show: function(message) {
            $rootScope.flash = message;
        },
        clear: function() {
            $rootScope.flash = "";
        }
    }
});
app.factory("SessionService", function() {
    return {
        get: function(key) {
            return sessionStorage.getItem(key);
        },
        set: function(key,val) {
            sessionStorage.setItem(key,val);
        },
        unset: function(key) {
            sessionStorage.removeItem(key);
        }
    };
});

app.factory("AuthenticationService", function($http, $location, SessionService, FlashService) {
    var cacheSession = function() {
        SessionService.set('authenticated', true);
    };
    var uncacheSession = function() {
        SessionService.unset('authenticated');
    };

    var loginError = function(response) {
        FlashService.show(response.flash);
    };

    return {
        login: function(credentials) {
            var login = $http.post("/login", credentials);
            //console.log('before cacheSession');
            login.success(cacheSession);
            login.success(FlashService.clear);
            login.error(loginError);
            return login;
        },
        logout: function() {
            var logout = $http.get("/logout");
            logout.success(uncacheSession);
            return logout;
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

app.controller("HomeController", function($scope, $location, AuthenticationService, expiry) {
    $scope.title = "Home";
    $scope.message = "This is a message";

    $scope.logout = function() {
        AuthenticationService.logout().success(function() {
            $location.path('/login');
        });
    };

    $scope.rowCollection = [
        {firstName: 'Laurent', lastName: 'Renard', birthDate: new Date('1987-05-21'), balance: 102, email: 'whatever@gmail.com'},
        {firstName: 'Blandine', lastName: 'Faivre', birthDate: new Date('1987-04-25'), balance: -2323.22, email: 'oufblandou@gmail.com'},
        {firstName: 'Francoise', lastName: 'Frere', birthDate: new Date('1955-08-27'), balance: 42343, email: 'raymondef@gmail.com'}
    ];
});

app.controller("UsersController", function() {});

app.controller("ExtensionsController", function() {});