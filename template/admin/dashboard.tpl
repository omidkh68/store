<?php
if(isset($temp['reports'])) {
    $allUsers = $temp['reports']['allUsers'];
    $allOnlineUser = $temp['reports']['allOnlineUser'];
    $allUserPurchased = $temp['reports']['allUserPurchased'];
    $allProducts = $temp['reports']['allProducts'];
    $allProductsQuantity = $temp['reports']['allProductsQuantity'];
    $allProductsPurchased = $temp['reports']['allProductsPurchased'];
    $allProductsBrands = $temp['reports']['allProductsBrands'];
    $maxBrandsPurchased = $temp['reports']['maxBrandsPurchased'];
}
?>
    <div class="content">
        <div class="content-header">
            <h2 class="content-title rtl"><i class="fa fa-home"></i> داشبورد </h2>
        </div><!--/content-header -->

        <div class="content-body">
        <!-- APP CONTENT
        ================================================== -->
        <!-- DASHBOARD
        ================================================== -->
        <!-- Dashboard  -->
        <div id="error-placement"></div>

        <div class="row">
            <div class="col-md-4">
                <div id="overall-users" class="panel panel-animated panel-info bg-info animated fadeInUp" style="visibility: visible;">
                    <div class="panel-body">
                        <div class="panel-actions-fly">
                            <button data-refresh="#overall-users" data-error-place="#error-placement" title="refresh" class="btn-panel">
                                <i class="glyphicon glyphicon-refresh"></i>
                            </button><!--/btn-panel--><!--/btn-panel-->
                        </div><!--/panel-action-fly-->

                        <p class="lead rtl text-4">کاربران</p><!--/lead as title-->

                        <ul class="list-percentages row">
                            <li class="col-xs-4">
                                <p class="text-ellipsis rtl text-2">تعداد کل کاربران</p>
                                <p class="text-lg rtl text-2"><strong><?php (isset($allUsers)? print($allUsers): print("0")); ?></strong></p>
                            </li>
                            <li class="col-xs-4">
                                <p class="text-ellipsis rtl text-2">تعداد کاربران آنلاین</p>
                                <p class="text-lg rtl text-2"><strong><?php (isset($allOnlineUser)? print($allOnlineUser): print("0")); ?></strong></p>
                            </li>
                            <li class="col-xs-4">
                                <p class="text-ellipsis rtl text-2">تعداد کاربران خرید کرده</p>
                                <p class="text-lg rtl text-2"><strong><?php (isset($allUserPurchased)? print($allUserPurchased): print("0")); ?></strong></p>
                            </li>
                        </ul><!--/list-percentages-->
                        <div class="progress progress-xs progress-flat progress-inverse-inverse">
                            <div class="progress-bar progress-bar" role="progressbar" aria-valuenow="<?php (isset($allUsers)? print($allUsers): print("0")); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php (isset($allUsers)? print($allUsers): print("0")); ?>%">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                        <!--/help-block-->
                    </div><!--/panel-body-->
                </div><!--/panel overal-users-->
            </div><!--/cols-->

            <div class="col-md-4">
                <div id="overall-visitor" class="panel panel-animated panel-success bg-success animated fadeInUp" style="visibility: visible;">
                    <div class="panel-body">
                        <div class="panel-actions-fly">
                            <button data-refresh="#overall-visitor" data-error-place="#error-placement" title="refresh" class="btn-panel">
                                <i class="glyphicon glyphicon-refresh"></i>
                            </button><!--/btn-panel--><!--/btn-panel-->
                        </div><!--/panel-action-fly-->

                        <p class="lead rtl text-4">محصولات</p><!--/lead as title-->

                        <ul class="list-percentages row">
                            <li class="col-xs-4">
                                <p class="text-ellipsis rtl text-2">تعداد کل محصولات</p>
                                <p class="text-lg rtl text-2"><strong><?php (isset($allProducts)? print($allProducts): print("0")); ?></strong></p>
                            </li>
                            <li class="col-xs-4">
                                <p class="text-ellipsis rtl text-2">موجودی انبار</p>
                                <p class="text-lg rtl text-2"><strong><?php (isset($allProductsQuantity)? print($allProductsQuantity): print("0")); ?></strong></p>
                            </li>
                            <li class="col-xs-4">
                                <p class="text-ellipsis rtl text-2">تعداد محصولات فروخته شده</p>
                                <p class="text-lg rtl text-2"><strong><?php (isset($allProductsPurchased)? print($allProductsPurchased): print("0")); ?></strong></p>
                            </li>
                        </ul><!--/list-percentages-->
                        <div class="progress progress-xs progress-flat progress-inverse-inverse">
                            <div class="progress-bar progress-bar" role="progressbar" aria-valuenow="<?php (isset($allProducts)? print($allProducts): print("0")); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php (isset($allProducts)? print($allProducts): print("0")); ?>%">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                        <!--/help-block-->
                    </div><!--/panel-body-->
                </div><!--/panel overal-visitor-->
            </div><!--/cols-->

            <div class="col-md-4">
                <div id="overall-orders" class="panel panel-animated panel-warning bg-warning animated fadeInUp" style="visibility: visible;">
                    <div class="panel-body">
                        <div class="panel-actions-fly">
                            <button data-refresh="#overall-orders" data-error-place="#error-placement" title="refresh" class="btn-panel" data-url="#">
                                <i class="glyphicon glyphicon-refresh"></i>
                            </button><!--/btn-panel--><!--/btn-panel-->
                        </div><!--/panel-action-fly-->

                        <p class="lead rtl text-4">برند ها</p><!--/lead as title-->

                        <ul class="list-percentages row">
                            <li class="col-xs-6">
                                <p class="text-ellipsis rtl text-2">تعداد کل برند های طرف قرارداد</p>
                                <p class="text-lg rtl text-2"><strong><?php (isset($allProductsBrands)? print($allProductsBrands): print("0")); ?></strong></p>
                            </li>
                            <li class="col-xs-6">
                                <p class="text-ellipsis rtl text-2">بیشترین برند خریداری شده</p>
                                <p class="text-lg rtl text-2"><strong><?php (isset($maxBrandsPurchased)? print($maxBrandsPurchased): print("0")); ?></strong></p>
                            </li>
                        </ul><!--/list-percentages-->
                        <div class="progress progress-xs progress-flat progress-inverse-inverse">
                            <div class="progress-bar progress-bar" role="progressbar" aria-valuenow="<?php (isset($allProductsBrands)? print($allProductsBrands): print("0")); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php (isset($allProductsBrands)? print($allProductsBrands): print("0")); ?>%">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                        <!--/help-block-->
                    </div><!--/panel-body-->
                </div><!--/panel overal-orders-->
            </div><!--/cols-->
        </div>

    </div><!--/content -->