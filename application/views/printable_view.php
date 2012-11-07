<h3>PERSONAL DETAILS</h3><br/>
<div class="details" ng-mouseenter="$scope.showlinks = true;" ng-mouseleave="$scope.showlinks = false;">
	<table>
		<tr><td>Full Names: </td><td>Ivan du Toit</td></tr>
		<tr><td>Nationality: </td><td>South African</td></tr>
		<tr><td>Date of Birth: </td><td>28 April 1990</td></tr>
		<tr><td>Marital status: </td><td>Single</td></tr>
		<tr><td>Address:</td><td>347 Umgeni Street, Erasmuskloof x4, Pretoria, South Africa</td></tr>
		<tr><td>Cell: </td><td>(+27)760926242</td></tr>
		<tr><td>E-Mail: </td><td>{{email}}</td></tr>
	</table>
	<span ng-show="$scope.showlinks">
		<a href="http://github.com/ivan-du-toit"><img src="img/github.ico" class="link-icon"/>Github Profile</a>
		<a href="http://ivandutoit.blogspot.com/"><img src="img/blogger.ico" class="link-icon"/>Blog</a>
		<a href="http://plus.google.com/109733145121386015159"><img src="img/googleplus.ico" class="link-icon"/>Google Plus Profile</a>
		<a href="http://www.linkedin.com/profile/view?id=47091934"><img src="img/linkedin.ico" class="link-icon"/>Linkedin Profile</a>
		
	</span>
                                            

</div>
<br/>
<div>
	<h2 class="sub_title">Occupation History</h2>
		<ul class="items">
		<li class="thumbnail" ng-repeat="occupation in occupations" ng-mouseenter="occupations[$index].show = true;" ng-mouseleave="occupations[$index].show = false;">
			<span class="item_title">{{occupation.name}}</span>
			<span class="occ_date">{{occupation.start_date}} to {{(occupation.end_date == null) && 'Current' || occupation.end_date}}</span>
			<span ng-show="occupation.show">
				<span class="relatedCategory label label-info" ng-repeat="category in occupation.related"><a href="#/occupation/{{occupation.id}}/{{category.id}}">{{category.name}}</a></span>
				<span class="relatedCategory label label-info" ng-repeat="project in occupation.projects"><a href="#/project/{{project.id}}/">{{project.name}}</a></span>
			</span>
			<p class="desc" ng-bind-html-unsafe="occupation.description"></p>
		</li>
	</ul>
	
	<h2 class="sub_title">Projects</h2>
	<ul class="items">
		<li class="thumbnail" ng-repeat="project in projects" ng-mouseenter="projects[$index].show = true;" ng-mouseleave="projects[$index].show = false;">
			<span class="item_title">{{project.name}}</span>
			<span ng-show="project.show">
				<span class="relatedCategory label label-info" ng-repeat="category in project.related"><a href="#/project/{{project.id}}/{{category.id}}">{{category.name}}</a></span>
				<span class="relatedCategory label label-info" ng-repeat="job in project.occupation"><a href="#/occupation/{{job.id}}/{{category.id}}">{{job.name}}</a></span>
			</span>
			<p class="desc" ng-bind-html-unsafe="project.description"></p>
		</li>
	</ul>

	<h2 class="sub_title">Achievements</h2>
	<ul class="items">
		<li class="thumbnail" ng-repeat="achievement in achievements" ng-mouseenter="achievements[$index].show = true;" ng-mouseleave="achievements[$index].show = false;">
			<span class="item_title">{{achievement.name}}</span>
			<span ng-show="achievement.show">
				<span class="relatedCategory label label-info" ng-repeat="category in achievement.related"><a href="#/category/{{category.id}}">{{category.name}}</a></span>
			</span>
			<p class="desc" ng-bind-html-unsafe="achievement.description"></p>
		</li>
	</ul>
	
	<h2 class="sub_title">References</h2>
	<ul class="items">
		<li class="thumbnail" ng-repeat="ref in refs" ng-mouseenter="refs[$index].show = true;" ng-mouseleave="refs[$index].show = false;">
			<span class="item_title">{{ref.name}}</span>
			<span ng-show="ref.show">
				<span class="relatedCategory label label-info" ng-repeat="category in ref.related"><a href="#/category/{{category.id}}">{{category.name}}</a></span>
				<span class="relatedCategory label label-info" ng-repeat="job in ref.occupations"><a href="#/occupation/{{job.id}}/{{ref.catID}}">{{job.name}}</a></span>
			</span>
			<p class="desc" ng-bind-html-unsafe="ref.description"></p>
		</li>
	</ul-->
</div>
