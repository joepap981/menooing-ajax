<!-- Dashboard Index -->
<!-- Custom CSS -->
<link href="css/user/dashboard.css" rel="stylesheet">

<script>
  //popover
  $(function () {
    $('[data-toggle="popover"').popover()
  });

  $('.popover-dismiss').popover({
  trigger: 'focus'
});
</script>

<div class="content-box" ng-controller="restaurantRegisterCtrl">
  <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Tell us a little bit about what kind of restaurant you are planning. </h3>
    <p> Kind of food are you making? </p>
  </div>
  <div class="margin-auto">
    <form name="restaurantRegistration" class="restaurant-information-form" >
      <div class="form-group row">
        <span class="col-label">Restaurant Cuisine</span>
        <select class="custom-select col-input" id="restaurantCuisine" ng-model="restaurant.cuisine">
          <option value="American" selected>American</option>
          <option value="British">British</option>
          <option value="Caribbean">Caribbean</option>
          <option value="Chinese">Chinese</option>
          <option value="French">French</option>
          <option value="Greek">Greek</option>
          <option value="Indian">Indian</option>
          <option value="Italian">Italian</option>
          <option value="Japanese">Japanese</option>
          <option value="Mediterranean">Mediterranean</option>
          <option value="Mexican">Mexican</option>
          <option value="Moroccan">Moroccan</option>
          <option value="Spanish">Spanish</option>
          <option value="Thai">Thai</option>
          <option value="Turkish">Turkish</option>
          <option value="Korean">Korean</option>
        </select>
      </div>
      <div class="form-group row">
        <span class="col-label">Restaurant Category</span>
        <select class="custom-select col-input" id="restaurantCategory" ng-model="restaurant.category">
          <option value="Casual Dining" selected>Casual Dining</option>
          <option value="Fine Dining">Fine Dining</option>
          <option value="Fast Casual">Fast Casual</option>
          <option value="Fast Food">Fast Food</option>
        </select>
      </div>
      <p class="text-center mt-4"> As a Sharee, what would you need from your Sharer?? </p>
      <div class="form-group">
        <div class="row">
          <div class="form-check col">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1"> Time </label>
            <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Time"
             data-content="And here's some amazing content. It's very engaging. Right?">?</a>
          </div>
          <div class="form-check col">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
            <label class="form-check-label" for="defaultCheck2">Labor</label>
            <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Labor"
            data-content="And here's some amazing content. It's very engaging. Right?">?</a>
          </div>
        </div>
        <div class="row">
          <div class="form-check col">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
            <label class="form-check-label" for="defaultCheck2">Space</label>
            <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Space"
            data-content="And here's some amazing content. It's very engaging. Right?">?</a>
          </div>
          <div class="form-check col">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
            <label class="form-check-label" for="defaultCheck2">Equipment</label>
            <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Equipment"
            data-content="And here's some amazing content. It's very engaging. Right?">?</a>
          </div>
        </div>
        <div id="small-left-margin" class="row">
          <div class="col-label">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
              <label class="form-check-label " for="defaultCheck2">Other</label>
              <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Other"
              data-content="And here's some amazing content. It's very engaging. Right?">?</a>
            </div>
          </div>
          <input id="narrowInput" type="text" class="form-control col-input" placeholder="">
        </div>
      </div>

      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new-sharee')" class="btn btn-secondary"> Back </button>
        <button ng-click="createRestaurant()" class="btn btn-primary"> Create Restaurant </button>
      </div>
    </form>



  </div>
</div>
