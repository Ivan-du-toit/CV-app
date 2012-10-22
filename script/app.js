angular.module('cv', ['ngSanitize']).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider.
      when('/cronological', {templateUrl: 'cv/cronological', controller: cronicalCtrl}).
      when('/category/:catId', {templateUrl: 'cv/category', controller: categoryCtrl}).
	  when('/occupation/:occId/:catId', {templateUrl: 'cv/jobdetail', controller: JobCategoryCtrl}).
	  //when('/occupation/:occId', {templateUrl: 'cv/jobdetail', controller: JobCategoryCtrl}).
	  when('/about', {templateUrl: 'cv/about', controller: categoryCtrl}).
      otherwise({redirectTo: '/cronological'});
}]).run(function($rootScope, $location) {
    $rootScope.location = $location;
});