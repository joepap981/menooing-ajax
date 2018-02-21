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

<div class="content-box" ng-controller="restaurantCtrl">
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
        <select class="custom-select col-input" id="restaurantCuisine">
          <option selected>Choose...</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
      <div class="form-group row">
        <span class="col-label">Restaurant Category</span>
        <select class="custom-select col-input" id="restaurantCategory">
          <option selected>Choose...</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
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
          <input id="narrowInput" type="text" class="form-control col-input" placeholder="" required>
        </div>
      </div>

      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new-sharee')" class="btn btn-secondary"> Back </button>
        <button ng-click="saveAndContinue('/restaurant-new-success')" class="btn btn-primary"> Create Restaurant </button>
      </div>
    </form>



  </div>
</div>
