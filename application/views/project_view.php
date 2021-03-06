<ul class="items">
	<li class="thumbnail" ng-mouseenter="project.show = true;" ng-mouseleave="project.show = false;">
		<span class="item_title">{{project.name}}</span>
		<span ng-show="project.show">
			<span class="relatedCategory label label-info" ng-repeat="category in project.related"><a href="#/project/{{project.id}}/{{category.id}}">{{category.name}}</a></span>
			<!--span class="relatedCategory label label-info"><a href="#/occupation/{{project.occupation[0].id}}/">{{project.occupation[0].name}}</a></span-->
			<span class="relatedCategory label label-info" ng-repeat="job in project.occupation"><a href="#/occupation/{{job.id}}/{{category.id}}">{{job.name}}</a></span>
		</span>
		<p class="desc" ng-bind-html-unsafe="project.description"></p>
		<div ng-hide="items.length == 0">
			<h2 class="sub_title">{{items[0].category}} in {{project.name}}</h2> <span><a href="#/category/{{items[0].catID}}">View all {{items[0].category}}</a></span>
			<ul class="items">
				<li class="thumbnail" ng-repeat="item in items" ng-mouseenter="items[$index].show = true;" ng-mouseleave="items[$index].show = false;">
					<span class="item_title">{{item.name}}</span>
					<span ng-show="item.show">
						<span class="relatedCategory label label-info" ng-repeat="category in item.related"><a href="#/category/{{category.id}}">{{category.name}}</a></span>
						<span class="relatedCategory label label-info" ng-repeat="project in item.projects"><a href="#/project/{{project.id}}">{{project.name}}</a></span>
						<span class="relatedCategory label label-info" ng-repeat="job in item.occupations"><a href="#/occupation/{{job.id}}/{{items[0].catID}}">{{job.name}}</a></span>
					</span>
					<p class="desc" ng-bind-html-unsafe="item.description"></p>
				</li>
			</ul>
		</div>
	</li>
</ul>