<!DOCTYPE html>
<html lang="en" ng-app="cv">
<head>
	<meta charset="utf-8">
	<title>Ivan du Toit's Resume</title>
	<link rel="stylesheet"  href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<!--script src="script/angular.min.js" type="text/javascript"></script-->
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.2/angular.min.js"></script>
	<script src="script/angular-sanitize.min.js" type="text/javascript"></script>
	<script src="script/app.js" type="text/javascript"></script>
	<script src="script/controllers.js" type="text/javascript"></script>
</head>
<body>
	<div id="page">
		<div id="content">
			<div class="navbar">
				<div class="navbar-inner">
					<a class="brand" href="#">Ivan du Toit's CV</a>
					<ul class="nav">
						<li id="homelink" class="{{location.path()=='/cronological' && 'active' || ''}}"><a href="#/cronological">Printable CV</a></li>
						<li id="aboutlink" class="{{location.path()=='/about' && 'active' || ''}}"><a href="#/about">About</a></li>
					</ul>
                                        <a ng-href="#/search/{{keywords}}" class="btn pull-right"><i class="icon-search"></i> Search</a>
                                        <input id="searchBar" type="search" class="input-medium pull-right search-query search-box" placeholder="Search" ng-model="keywords"></input>
				</div>
			</div>
			<div ng-view></div>
		</div>
	</div>
</body>
</html>