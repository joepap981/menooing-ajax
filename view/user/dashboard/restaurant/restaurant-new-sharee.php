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
      <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Hey Sharee!</h3>
    <p> Before we move on to anything, we need some information and documents to identify you!</p>
  </div>
  <div class="margin-auto">
    <form name="restaurantRegistration" class="restaurant-information-form">
      <div class="form-group">
        <label for="user_name">Name</label>
        <input name="name" type="text" ng-class="{'submitted':restaurantRegistration.submitted}" ng-model="restaurant.name" class="form-control" placeholder="" required>
      </div>
      <div class="form-group">
        <label for="user_name">Mobile</label>
        <input name="name" type="text" ng-class="{'submitted':restaurantRegistration.submitted}" ng-model="restaurant.name" class="form-control" placeholder="" required>
      </div>
      <div class="ml-3">
        <div class="form-group row">
          <label>Copy of Drivers License</label>
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Drivers License"
          data-content="And here's some amazing content. It's very engaging. Right?">?</a>
          <input id="restaurantAddFile" type="file" placeholder="" required>
        </div>
        <div class="form-group row">
          <label>Food Manager Certificate</label>
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Food Manager Certificate"
          data-content="And here's some amazing content. It's very engaging. Right?">?</a>
          <input id="restaurantAddFile" type="file" placeholder="" required>
        </div>
      </div>

      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new')" class="btn btn-secondary"> Back </button>
        <button ng-click="saveAndContinue('/restaurant-new-sharee2')" class="btn btn-primary"> Continue </button>
      </div>

    </form>
  </div>
</div>
