
var app = angular.module("githubViewer");

var MainController = function (
    $scope ,$location) {

    // Functions

    $scope.search = function (username){

        $location.path("/user/" + username);
    };



    //Scope variables
};
app.controller("MainController",MainController);