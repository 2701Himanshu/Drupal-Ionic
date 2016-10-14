angular.module('starter.services', [])

.factory('Drupal', function($http) {
  return {
    nodes : $http.get('http://localhost/cms/DP/Headless/d8/api/article')
  }
  
})

.factory('DNode',function ($http) {
  var content = [];
  return {
    getNode: function(id){
        return $http.get('http://localhost/cms/DP/Headless/d8/api/' + id + '/article')
          .then(function(data){
            content = data;
            return content;
          });
      }
    }
});