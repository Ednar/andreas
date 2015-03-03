(function() {

    var module = angular.module("githubViewer");

    var RepoController = function($scope, $routeParams, github) {

        var onRepo = function(data) {
            $scope.repo = data;
        };

        var reponame = $routeParams.reponame;
        var username = $routeParams.username;

        github.getRepoDetails(username, reponame).then(function(data) {
            $scope.repo = data;
        });
    };

    module.controller("RepoController", RepoController);
}());