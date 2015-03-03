var app = angular.module("Andreas");

var CartController = function($scope) {
    $scope.message = "Hello Cart";
};

app.controller("CartController", CartController);
