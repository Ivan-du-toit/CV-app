function printableCtrl($scope, $http) {
	$scope.showRelated = function(id) {
		$scope.occupations[id].show = true;
	}
	
	$scope.hideRelated = function(id) {
		$scope.occupations[id].show = false;
	}
	
	$scope.showCategory = function(id) {
		alert(id);
	}
	
	$http.get('cv/printData').success(function(data) {
		$scope.occupations = data.occupations;
		$scope.refs = data.refs;
		$scope.achievements = data.achievements;
		$scope.projects = data.projects;
	});
	
	var n = "Ivan";
	var a = '\u0040';
	$scope.email = n+a+"tryfinally.co.za";
}

function JobCategoryCtrl($scope, $http, $routeParams) {
	$scope.catID = $routeParams.catID;
	$scope.jobID = $routeParams.occID;

	$http.get('cv/jobdetail/'+$scope.jobID+'/'+$scope.catID).success(function(data) {
		$scope.occupations = data.occupations;
		$scope.items = data.items;
	});
}


function categoryCtrl($scope, $http, $routeParams) {
	$scope.catID = $routeParams.catID;
	
	$http.get('cv/category/'+$scope.catID).success(function(data) {
		$scope.items = data;
	});
}

function searchCtrl($scope, $http, $routeParams) {
	$scope.term = $routeParams.term;
	
	$http.get('cv/search/'+$scope.term).success(function(data) {
		$scope.items = data;
		$scope.occupations = data.occupation;
		$scope.projects = data.project;
		$scope.metas = data.meta;
	});
}

function projectCtrl($scope, $http, $routeParams) {
	$scope.projectID = $routeParams.projectID;
	$scope.catID = $routeParams.catID;
	
	$http.get('cv/project/'+$scope.projectID+'/'+$scope.catID).success(function(data) {
		$scope.project = data.project;
        $scope.items = data.items;
	});
}