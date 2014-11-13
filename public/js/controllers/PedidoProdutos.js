var App = angular.module('App',[]);
        App.config(function($interpolateProvider) {
              $interpolateProvider.startSymbol('<%');
              $interpolateProvider.endSymbol('%>');
        });

var PedidoProdutoCtrl = function ($scope, $http, $window){
               $scope.lista = {{ PedidoProduto::getJson() }}
        };