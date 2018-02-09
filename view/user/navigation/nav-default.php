<!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top">
  <!-- Sidebar when User is logged in-->
  <div ng-click ="redirect('/')" class="navbar-brand cursor-pointer"> menooing </div>


  <!--show when NO session -->
  <div class="btn">
    <span ng-hide="isURL('/sharekitchen')" class="clear-btn larger-space" ng-click="redirect('/sharekitchen')"> Share Your Kitchen </span>
    <span class="clear-btn" ng-click="redirect('/signin')"> Sign in</span>
    <span class="clear-btn" ng-click="redirect('/signup')">Sign up</span>
  </div>
</nav>
