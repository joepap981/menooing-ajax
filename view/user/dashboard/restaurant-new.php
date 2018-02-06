<div id="restaurant-location-input">
  <h3> Welcome {{ session['user_first_name']}}! </h3>
  <h5> We'll start with the basic information of your restaurant!</h5>
  <br></br>
  <h5> Step 1: Location </h5>
  <form>
    <div class="form-group">
      <label for="address1">Address 1</label>
      <input type="text" class="form-control" id="address1" placeholder="Street address...">
    </div>
    <div class="form-group">
      <label for="address2">Address 2</label>
      <input type="text" class="form-control" id="address2" placeholder="Apt or suite number...">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">ZIP Code</label>
      <input type="text" class="form-control" id="zipcode" placeholder="ZIP">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
