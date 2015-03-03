
var app = angular.module("githubViewer");

var UserController = function (
    $scope, github, $routeParams) {

    // Functions

    var onUserComplete = function(data){
        $scope.user = data;
        github.getRepos($scope.user).then(onRepos);
    };

    var onRepos = function(data){
        $scope.repos = data;
    };

    //Scope variables
    $scope.username = $routeParams.username;
    $scope.repoSortOrder = '+name';
    github.getUser($scope.username).then(onUserComplete)
};
app.controller("UserController",UserController);