angular.module('cv', ['ngSanitize']).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider.
      when('/printable', {templateUrl: 'cv/printable', controller: printableCtrl}).
      when('/category/:catID', {templateUrl: 'cv/category', controller: categoryCtrl}).
	  when('/occupation/:occID/:catID', {templateUrl: 'cv/jobdetail', controller: JobCategoryCtrl}).
	  when('/about', {templateUrl: 'cv/about', controller: categoryCtrl}).
	  when('/search/:term', {templateUrl: 'cv/search', controller: searchCtrl}).
	  when('/project/:projectID/:catID', {templateUrl: 'cv/project', controller: projectCtrl}).
      otherwise({redirectTo: '/printable'});
}]).run(function($rootScope, $location) {
    $rootScope.location = $location;
});