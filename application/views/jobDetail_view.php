<ul class="items">
	<li class="thumbnail" ng-repeat="occupation in occupations" ng-mouseenter="occupations[$index].show = true;" ng-mouseleave="occupations[$index].show = false;">
		<span class="item_title">{{occupation.name}}</span>
		<span class="occ_date">{{occupation.start_date}} to {{(occupation.end_date == null) && 'Current' || occupation.end_date}}</span>
		<span ng-show="occupation.show">
			<span class="relatedCategory" ng-repeat="category in occupation.related" "><a href="#/occupation/{{occupation.id}}/{{category.id}}">{{category.name}}</a></span>
		</span>
		<p class="desc" ng-bind-html-unsafe="occupation.description"></p>
		<h2 class="sub_title">{{items[0].category}}</h2> <span><a href="#/category/{{items[0].catID}}">View all items</a> in the {{items[0].category}} category.</span>
		<ul class="items">
			<li class="thumbnail" ng-repeat="item in items" ng-mouseenter="items[$index].show = true;" ng-mouseleave="items[$index].show = false;">
				<span class="item_title">{{item.name}}</span>
				<span ng-show="item.show">
					<span class="relatedCategory" ng-repeat="category in item.related"><a href="#/category/{{category.id}}">{{category.name}}</a></span>
				</span>
				<p class="desc" ng-bind-html-unsafe="item.description"></p>
			</li>
		</ul>
	</li>
</ul>