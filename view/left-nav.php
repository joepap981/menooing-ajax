<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
<br>





<table class="table">
<tr><th>Account</th></tr>	
<tr  ng-class="{selectBtn: x.itemSysNo == selNav.itemSysNo } " ng-repeat="x in navList | filter: { type: 'P' } ">
<td><a class="nav-link"  ng-click="selectNav(x)">{{x.name}} </a></td>
</tr>
</table>




<table class="table">
<tr><th>MENU</th></tr>	
<tr  ng-class="{selectBtn: x.itemSysNo == selNav.itemSysNo } " ng-repeat="x in navList | filter: { type: 'N' } ">
<td><a class="nav-link"  ng-click="selectNav(x)"> {{x.name}} </a></td>
</tr>
</table>

<table class="table">
<tr><th>Order</th></tr>	
<tr  ng-class="{selectBtn: x.itemSysNo == selNav.itemSysNo } " ng-repeat="x in navList | filter: { type: 'O' } ">
<td><a class="nav-link"  ng-click="selectNav(x)"> {{x.name}} </a></td>
</tr>
</table>



<table class="table">
<tr><th>ADMIN</th></tr>	
<tr  ng-class="{selectBtn: x.itemSysNo == selNav.itemSysNo } " ng-repeat="x in navList | filter: { type: 'A' } ">
<td><a class="nav-link"  ng-click="selectNav(x)"> {{x.name}} </a></td>
</tr>
</table>


</nav>

