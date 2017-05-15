        var myApp=angular.module('new_app',[])
        myApp.controller('ShowController', function($scope) {
            $scope.menuState = {
                show: false
            }
            $scope.toggleImg = {
                show: false
            }
            $scope.toggleMenu = function() {
                $scope.menuState.show = !$scope.menuState.show;
            }
            $scope.toggleImg = function() {
                $scope.toggleImg.show = !$scope.toggleImg.show;
            } 
       }); 