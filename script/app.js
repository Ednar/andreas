(function(){
    var app = angular.module("Andreas", ["ngRoute"]);
    app.config(function($routeProvider){
        $routeProvider
            .when("/main", {
                templateUrl: "view/main.html",
                controller: "MainController"
            })
            .when("/prints",{
                templateUrl: "view/prints.html",
                controller: "ProductListController"
            })
            .when("/print/:param",{
                templateUrl: "view/print.html",
                controller: "PrintInfoController"
            })
            .when("/cart:param",{
                templateUrl: "view/shopping_cart.html",
                controller: "CartController"
            })
            .otherwise({redirectTo:"/main"});
    });

}());