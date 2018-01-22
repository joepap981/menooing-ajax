
          <section class="row text-center placeholders">
            <div class="col-6 col-sm-3 placeholder" ng-repeat="x in storeList " ng-click="selectStore(x)">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid " alt="Generic placeholder thumbnail">
              <h4>[{{x.storeName}}]</h4>
              <div class="text-muted">Store: [{{x.itemNo}}]</div>
            </div>
          </section>

          <button>Add New Store</button>

