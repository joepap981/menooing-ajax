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
      <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> What will you be sharing? </h3>
    <p> What type of excess capacity will you be offering your tenants? </p>
  </div>
  <div class="margin-auto">
    <div class="restaurant-information-form">
      <form name="restaurantRegistration">
        <div class="form-group ml-large">
          <div class="row">
            <div class="form-check col">
              <input class="form-check-input" type="checkbox" value="" id="timeCheck" >
              <label class="form-check-label" for="defaultCheck1"> Time </label>
              <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Time"
               data-content="You give a portion of your restaurant's hours for your sharee.">?</a>
            </div>
            <div class="form-check col">
              <input class="form-check-input" type="checkbox" value="" id="laborCheck">
              <label class="form-check-label" for="defaultCheck2">Labor</label>
              <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Labor"
              data-content="You can have one of employees do some of the work for your sharee.">?</a>
            </div>
          </div>
          <div class="row">
            <div class="form-check col">
              <input class="form-check-input" type="checkbox" value="" id="spaceCheck">
              <label class="form-check-label" for="defaultCheck2">Space</label>
              <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Space"
              data-content="The idle space in your kitchen can be shared for extra cash.">?</a>
            </div>
            <div class="form-check col">
              <input class="form-check-input" type="checkbox" value="" id="equipmentCheck">
              <label class="form-check-label" for="defaultCheck2">Equipment</label>
              <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Equipment"
              data-content="You can let your sharee use the equipment in you kitchen.">?</a>
            </div>
          </div>
          <div id="small-left-margin" class="row">
            <div class="col-label">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                <label class="form-check-label " for="defaultCheck2">Other</label>
                <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Other"
                data-content="Anything else you want to share with your sharee.">?</a>
              </div>
            </div>
            <input id="narrowInput" type="text" class="form-control col-input" placeholder="" required>
          </div>
        </div>
      </form>
      <small class="text-nowrap ml-large"> You can skip this step for now and edit them later.</small>
      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new-sharer3')" class="btn btn-secondary"> Back </button>
        <button ng-click="createRestaurant()" class="btn btn-primary"> Create Restaurant </button>
      </div>
    </div>
  </div>
</div>
