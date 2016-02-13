  angular.module('changeExample', [])
    .controller('ExampleController', ['$scope', function($scope) {
      $scope.counter = 0;
      $scope.change = function() {
        $scope.counter++;
      };
    }]);
    
function GetUsers($scope, $http) {
    // this is where the JSON from api.php is consumed
    $http.get('http://localhost/ArishaTest/gitTest/index.php').
        success(function(data) {
            // here the data from the api is assigned to a variable named users
            $scope.users = data;
        });
}
