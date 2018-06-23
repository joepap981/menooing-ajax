<link rel="stylesheet" href="css/user/pagination-custom.css">

<div class="container mt-5" ng-controller="restaurantSearchCtrl">
  <form class="">
    <div class="d-flex">
      <div class="p-2">
        <label class="mr-sm-2" for="inlineFormCustomSelect"> Search by </label>
        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" ng-model="search_option">
          <option value="restaurant_name"> Name </option>
          <option value="restaurant_locality"> City </option>
          <option value="restaurant_cuisine"> Cuisine </option>
        </select>
      </div>

      <div class="p-2">
        <input type="text" class="form-control" placeholder="Search" ng-model="condition_input">
        <!-- <input ng-show="search_option != 'restaurant_locality'" type="text" class="form-control" placeholder="Search" ng-model="condition_input">
        <input ng-show = "search_option ==  'restaurant_locality'" name="location" class="form-control" ng-controller= "googlePlaceCtrl" id="autocomplete" placeholder="Search for locality" ng-focus="geolocate()" type="text"></input> -->
      </div>

      <div class="p-2">
        <button class="btn btn-primary" ng-click="filterRestaurantList()">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </div>
  </form>

  <div id="restaurant-list">
    <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item" ng-repeat="restaurant in userRestaurants.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage))">
        <div class="card h-80 mt-5 mb-t">
          <a href="#" ng-click="redirectToProfile(restaurant.restaurant_id)"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="#" ng-click="redirectToProfile(restaurant.restaurant_id)">{{ restaurant.restaurant_name }}</a>
            </h4>
            <p class="card-text">{{ restaurant.restaurant_locality}}, {{ restaurant.restaurant_administrative_area_level_1 }} </p>
            <p class="card-text"> Status: {{ restaurant.restaurant_status }} <p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <ul class="pagination mt-5 d-flex justify-content-center" uib-pagination total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()" items-per-page="itemsPerPage"></ul>

</div>
