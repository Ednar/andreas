var app = angular.module("Andreas");

var PrintInfoController = function($scope, $routeParams, $http, $location) {
    $scope.param = $routeParams.param;

    $http.get('controller/ControllerAdapter.php/PrintInfo/getPrintInfo/' + $scope.param)
        .success(function(data) {
            $scope.data =  data;
        }).error(function(data) {
            $scope.data = "Gick inte att hämta data :_(";
        });

    $scope.submit = function(typeID, sizeID) {
        alert(typeID + sizeID);
    };

    $scope.prices = {
        15: 1453,
        16: 2643,
        17: 562,
        18: 1235,
        19: 7883,
        110: 11743,
        111: 12899,
        112: 14740,
        113: 4620,
        114: 4970,
        115: 7139,
        116: 77345,
        217: 7883,
        218: 11743,
        219: 12899,
        220: 14740,
        221: 4620,
        222: 4970,
        223: 7139,
        224: 77345,
        31: 7883,
        32: 11743,
        33: 12899,
        34: 14740,
        35: 4620,
        36: 4970,
        37: 7139,
        38: 77345
    };

    $scope.setPrice = function(typeID, sizeID) {
        var id = typeID + sizeID;
        $scope.price = $scope.prices[id];
    }


    $scope.submit = function(printID, typeID, sizeID) {
        var uniqueID = printID + typeID + sizeID;
        $http.post('controller/ControllerAdapter.php/ShoppingCart/')
        $location.path('/cart');
    }
};

app.controller("PrintInfoController", PrintInfoController);