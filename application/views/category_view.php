<h2 class="sub_title">{{items[0].category}}</h2>
<ul class="items">
	<li class="thumbnail" ng-repeat="item in items" ng-mouseenter="items[$index].show = true;" ng-mouseleave="items[$index].show = false;">
		<span class="item_title">{{item.name}}</span>
		<span ng-show="item.show">
			<span class="relatedCategory label label-info" ng-repeat="category in item.related"><a href="#/category/{{category.id}}">{{category.name}}</a></span>
			<span class="relatedCategory label label-info" ng-repeat="job in item.occupations"><a href="#/occupation/{{job.id}}/{{catId}}">{{job.name}}</a></span>
		</span>
		<p class="desc" ng-bind-html-unsafe="item.description"></p>
	</li>
</ul>