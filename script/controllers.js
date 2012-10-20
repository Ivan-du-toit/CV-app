function cronicalCtrl($scope, $http) {
	$scope.showRelated = function(id) {
		$scope.occupations[id].show = true;
	}
	
	$scope.hideRelated = function(id) {
		$scope.occupations[id].show = false;
	}
	
	$scope.showCategory = function(id) {
		alert(id);
	}
	
	$http.get('cv/cron').success(function(data) {
		$scope.occupations = data.occupations;
		$scope.refs = data.refs;
		$scope.achievements = data.achievements;
	});
	
	var n = "Ivan";
	var s = "dtoit";
	var a = '\u0040';
	$scope.email = n+s+a+"gmail.com";
}

function JobCategoryCtrl($scope, $http, $routeParams) {
	$scope.catId = $routeParams.catId;
	$scope.jobId = $routeParams.occId;

	$http.get('cv/jobdetail/'+$scope.jobId+'/'+$scope.catId).success(function(data) {
		$scope.occupations = data.occupations;
		$scope.items = data.items;
	});
}


function categoryCtrl($scope, $http, $routeParams) {
	$scope.catId = $routeParams.catId;
	
	$http.get('cv/category/'+$scope.catId).success(function(data) {
		$scope.items = data;
	});
}