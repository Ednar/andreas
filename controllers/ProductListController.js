var app = angular.module("Andreas");

var ProductListController = function($scope, $http) {
    $http.get('controller/ControllerAdapter.php/ProductList/getAllPrints')
        .success(function(data) {
            $scope.data = data;
        }).error(function(data) {
            $scope.data = "Gick inte att hämta data :_(";
        });
};

app.controller("ProductListController", ProductListController);
