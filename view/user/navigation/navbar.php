<!-- Top Navigation -->

<!-- NO SESSION (NOT LOGGED IN) -->
<nav class="navbar navbar-light bg-light static-top" ng-if="session['user_id'] == null">
    <!--logo-->
    <div ng-click ="redirect('/')" class="navbar-brand cursor-pointer"> menooing </div>

    <div class="row ml-auto">
      <div ng-click = "redirect('/restaurant-search')" class="clear-btn nav-item ml-auto"> Restaurants </div>
    </div>

    <div class="btn">
      <span class="clear-btn" ng-click="redirect('/signin')"> Sign in</span>
      <span class="clear-btn" ng-click="redirect('/signup')">Sign up</span>
    </div>
</nav>

<!-- SESSION (LOGGED IN) -->
<nav class="navbar navbar-light bg-light static-top" ng-if="session['user_id'] != null">
  <!--logo-->
  <div ng-click ="redirect('/')" class="navbar-brand cursor-pointer"> menooing </div>
  <div class="row ml-auto">
    <div ng-click = "redirect('/restaurant-search')" class="clear-btn nav-item ml-auto"> Restaurants </div>
    <div class="clear-btn nav-item ml-auto" ng-click="redirect('/home')"> Dashboard </div>
  </div>
  <div class="nav-item dropdown">
    <!-- User ICON image -->
    <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img class="img-fluid rounded-circle user_img" src="/img/default-user.png" alt="">
    </a>

    <!--dropdown menu-->
    <span class="dropdown-menu" aria-labelledby="messagesDropdown">
      <a class="dropdown-item" ng-click="redirect('/home')">Dashboard</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Settings</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" ng-click="logout()">Logout</a>
    </span>
  </div>
</nav>
