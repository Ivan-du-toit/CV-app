<h2 class="sub_title"><span ng-show="occupations.length == 0 && projects.length == 0 && metas.length == 0">No </span>Results for {{term}}</h2>
<span ng-hide="occupations.length == 0"><h4>Occupations:</h4></span>
<ul class="items">
        <li class="thumbnail" ng-repeat="occupation in occupations" ng-mouseenter="occupations[$index].show = true;" ng-mouseleave="occupations[$index].show = false;">
                <span class="item_title">{{occupation.name}}</span>
                <span class="occ_date">{{occupation.start_date}} to {{(occupation.end_date == null) && 'Current' || occupation.end_date}}</span>
                <span ng-show="occupation.show">
                        <span class="relatedCategory label label-info" ng-repeat="category in occupation.related"><a href="#/occupation/{{occupation.id}}/{{category.id}}">{{category.name}}</a></span>
                </span>
                <p class="desc" ng-bind-html-unsafe="occupation.description"></p>
        </li>
</ul>

<span ng-hide="projects.length == 0"><h4>Projects:</h4></span>
<ul class="items">
    <li class="thumbnail" ng-repeat="project in projects" ng-mouseenter="projects[$index].show = true;" ng-mouseleave="projects[$index].show = false;">
        <span class="item_title">{{project.name}}</span>
        <span ng-show="project.show">
            <span class="relatedCategory label label-info" ng-repeat="category in project.related"><a href="#/project/{{project.id}}/{{category.id}}">{{category.name}}</a></span>
        </span>
        <p class="desc" ng-bind-html-unsafe="project.description"></p>
    </li>
</ul>

<span ng-hide="metas.length == 0"><h4>Data:</h4></span>
<ul class="items">
    <li class="thumbnail" ng-repeat="meta in metas" ng-mouseenter="metas[$index].show = true;" ng-mouseleave="metas[$index].show = false;">
        <span class="item_title">{{meta.name}}</span>
        <span ng-show="meta.show">
            <span class="relatedCategory label label-info" ng-repeat="category in meta.related"><a href="#/category/{{category.id}}">{{category.name}}</a></span>
        </span>
        <p class="desc" ng-bind-html-unsafe="meta.description"></p>
    </li>
</ul>