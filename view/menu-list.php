

      
<nav aria-label="breadcrumb" role="navigation">
<ol class="breadcrumb">
<div class="dropdown show">
<a class="btn btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

<span ng-if=" selStore.itemSysNo  === undefined ">Please Select the Store</span>
<span ng-if=" selStore.itemSysNo  !== undefined ">Current Selected Store: {{selStore.storeName}}</span>

</a>

<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
<a class="dropdown-item" ng-class="{selectBtn: x.itemSysNo == selType.itemSysNo } "  ng-repeat="x in storeList " ng-click="selectStore(x)" >VR [{{x.storeName}}] </a>


</div>
</div>
</ol>
</nav>

<div ng-if=" selStore.itemSysNo  !== undefined ">



  <ul class="nav nav-tabs">
  <li class="nav-item " ng-repeat="x in typeList ">
  <a class="nav-link active"  ng-class="{selectBtn: x.itemSysNo == selType.itemSysNo } "  ng-click="selectType(x)">{{x.name}}</a>
  </li>
  </ul>




  <!--li class="nav-item"   ng-repeat="x in typeList ">
  <a ng-class="{nav-link: x.itemSysNo == selType.itemSysNo } "  ng-click="selectType(x)">{{x.name}}{{x.itemSysNo == selType.itemSysNo }}</a>
  </li-->

  <div class="table-responsive"  >
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Header</th>
          <th>Header</th>
          <th>Header</th>
          <th>Header</th>
        </tr>
      </thead>
      <tbody>


        <tr ng-repeat="x in menuList " >
          <td>{{x.itemSysNo}} </td>
          <td>{{x.itemNo}} </td>
          <td>{{x.sDesc}} </td>
          
          <td>{{x.itemSysNo}} </td>
          <td>{{x.itemSysNo}} </td>
        </tr>
       
      </tbody>
    </table>
  </div>



</div>
