angular.module('starter.services', [])

.factory('Drupal', function($http) {
  return {
    nodes : $http.get('http://localhost/cms/DP/Headless/drupal7/api/node')
  }
})

.factory('DNode',function ($http) {
  var content = [];
  return {
    getNode: function(id){
        return $http.get('http://localhost/cms/DP/Headless/drupal7/api/node/' + id)
          .then(function(data){
            content = data;
            return content;
          });
      }
      //node : $http.get('http://localhost/cms/DP/Headless/drupal7/api/node/' + id)
    }
  });


/*
.factory('userService', function($http) {
  var users = [];

  return {
    getUsers: function(){
      return $http.get("https://www.yoursite.com/users").then(function(response){
        users = response;
        return users;
      });
    },
    getUser: function(id){
      for(i=0;i<users.length;i++){
        if(users[i].id == id){
          return users[i];
        }
      }
      return null;
    }
  }
})

*/