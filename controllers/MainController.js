var app = angular.module("Andreas");

var MainController = function($scope) {
    $scope.message = "Hello Routing";
};

app.controller("MainController", MainController);
