angular.module('starter.controllers', [])

.controller('AddCtrl',['$scope', '$http', function($scope, $http) {

  $scope.art = {};
  $scope.newTask = function(){

    var package = {};

    package.title = [{'value': $scope.art.Title}]
    package.body = [{'value': $scope.art.body}]
    package.type = [{"target_id": "article"}]
    //package._links = {"type": {"href": "http://localhost/cms/DP/Headless/d8/rest/type/node/article"}}

    //console.log(package);

    $http({
      url: 'http://localhost/cms/DP/Headless/d8/entity/node',
      method: 'POST',
      data: package,
      header: {
        //"Authorization": "",
        "X-CSRF-Token": "RNtx2jSIkbLcIzhfeb_QMIQ0VBpgnBkgWy3ifoKvXr0",  //rest/session/token 
        "Content-Type": "application/json",
      },
    })
    .success(function(data, status, headers, config){
      $scope.art.Title = '';
      $scope.art.body = '';
    })

  }

}])

.controller('ListCtrl', function($scope, Drupal, $http, $ionicLoading){

  $ionicLoading.show({
      template: '<ion-spinner icon="ripple" class="spinner-assertive""></ion-spinner>'
    }).then(function(){
       console.log("The loading indicator is now displayed");
    });

  Drupal.nodes
    .success(function(data){
      $scope.data = data;
      $scope.bdy = data[0].body[0].value;
        $ionicLoading.hide();
    });

  $scope.doRefresh = function(){
    $http.get('http://localhost/cms/DP/Headless/d8/api/article')
      .success(function(data) {
       $scope.data = data;
     })
    .finally(function() {
       // Stop the ion-refresher from spinning
       $scope.$broadcast('scroll.refreshComplete');
     });
  }
})

.controller('ArticleCtrl', function($rootScope, $ionicHistory, $scope, 
                                        $stateParams, DNode, $q, $ionicTabsDelegate){

    id = $stateParams.nid;
    $scope.nodes = DNode.getNode(id);
    //console.log($scope.data);

    $q.all([$scope.nodes]).then(function(data){
      $scope.data = data;
      $scope.img = data[0].data[0].field_image[0];
      if(data[0].data[0].field_image.length == 0){
          $scope.img = {
            'url': 'http://localhost:8100/img/ionic.png' 
          }
      }else {
          $scope.img = data[0].data[0].field_image[0];
      }
      $scope.bdy = data[0].data[0].body[0].value;
    });
    
    $ionicTabsDelegate.showBar(false);

    //overide back-button property
    $rootScope.$ionicGoBack = function() {
        $ionicHistory.goBack();
        $ionicTabsDelegate.showBar(true);
    };
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
