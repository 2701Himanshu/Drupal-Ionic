angular.module('starter.controllers', [])

.controller('DashCtrl', ['$scope', function($scope) {


  $scope.newTask = function(){

    /*var package = {};

    package.title = [{'value': $scope.Title}]
    package.body = [{'value': $scope.body}]
    package._links = {"$type": {"href": "http://localhost/cms/DP/Headless/drupal7/api/type/node/article"}}

    console.log(package);


    $http({
      url: 'http://localhost/cms/DP/Headless/drupal7/entity/node',
      method: 'POST',
      data: package,
      header: {
        "Content-Type": "application/json"
      },
    })
    .success(function(data, status, headers, config){
      $scope.Title = '';
      $scope.body = '';
    })*/

  }

}])

.controller('Drupal', function($scope, Drupal){
  Drupal.nodes
    .success(function(data){
      $scope.data = data;
    });
})

.controller('NodeCtrl', function($scope, $stateParams, DNode, $q){
  /*DNode.getNode.content
    .success(function (data){
      $scope.data = data;
    });*/
    id = $stateParams.nid;
    $scope.nodes = DNode.getNode(id);
    //console.log($scope.data);

    $q.all([$scope.nodes]).then(function(data){
      $scope.data = data;
      console.log($scope.data);
    });
})

.controller('ChatsCtrl', function($scope, Chats) {
  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  //
  //$scope.$on('$ionicView.enter', function(e) {
  //});

  $scope.chats = Chats.all();
  $scope.remove = function(chat) {
    Chats.remove(chat);
  };
})

.controller('ChatDetailCtrl', function($scope, $stateParams, Chats) {
  $scope.chat = Chats.get($stateParams.chatId);
})

.controller('AccountCtrl', function($scope) {
  $scope.settings = {
    enableFriends: true
  };
});
