
<ul class="nav nav-tabs">
<li class="nav-item " >
<a class="nav-link active"    ng-click="selectType(x)">Store</a>
</li>

<li class="nav-item " >
<a class="nav-link active"    ng-click="selectType(x)">Type</a>
</li>

</ul>




<!--li class="nav-item"   ng-repeat="x in typeList ">
<a ng-class="{nav-link: x.itemSysNo == selType.itemSysNo } "  ng-click="selectType(x)">{{x.name}}{{x.itemSysNo == selType.itemSysNo }}</a>
</li-->

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Header</th>
        <th>Header</th>
    </thead>
    <tbody>


      <tr ng-repeat="x in storeList " >
        <td>{{x.itemSysNo}} </td>
        <td>{{x.itemNo}} </td>
        <td>{{x.sDesc}} </td>
        

      </tr>
     
    </tbody>
  </table>
</div>
