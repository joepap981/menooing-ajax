<!-- Top Navigation -->

<!-- NO SESSION (NOT LOGGED IN) -->
<nav class="navbar navbar-light bg-light static-top" ng-if="session['user_id'] == null">
    <!--logo-->
    <div ng-click ="redirect('/')" class="navbar-brand cursor-pointer"> menooing </div>

    <div class="btn">
      <span> Apply for a Station Now</span>
    </div>
</nav>
