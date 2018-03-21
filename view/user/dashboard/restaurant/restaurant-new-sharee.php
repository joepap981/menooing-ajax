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
      <div class="progress-bar" role="progressbar" style="width: 33%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="restaurant-text-title">
    <h3> Hey Sharee!</h3>
    <p> Before we move on to anything, we need some information and documents to identify you!</p>
  </div>
  <div class="margin-auto">
    <form name="restaurantRegistration" class="restaurant-information-form">
      <div class="form-group">
        <label for="user_mobile">Mobile</label>
        <input name="mobile" type="text" ng-class="{'submitted':restaurantRegistration.submitted}" ng-model="user.phone" class="form-control"  required>
      </div>
      <div class="ml-3">
        <div class="form-group row">
          <label>Copy of Drivers License</label>
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Drivers License"
          data-content="Please upload a jpg, png, or pdf photocopy of your driver's license.">?</a>
          <input id="restaurantAddFile" type="file"  file-input ="user_id_img_ref" placeholder="">
        </div>
        <div class="form-group row">
          <label>Food Manager Certificate</label>
          <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Food Manager Certificate"
          data-content="Please upload a jpg, png, or pdf photocopy of your food manager certificate.">?</a>
          <input id="restaurantAddFile" type="file"  file-input ="user_cert_img_ref" placeholder="">
        </div>
      </div>

      <small class="text-nowrap text-center"> Your documents will be safe with us!</small>
      <div id="restaurantAddButtonbar" class="btn-toolbar mt-3">
        <button ng-click="redirect('/restaurant-new')" class="btn btn-secondary"> Back </button>
        <button ng-click="registerRestaurant('/restaurant-new-sharee2'); saveFile()" class="btn btn-primary"> Continue </button>
      </div>

    </form>
  </div>
</div>
