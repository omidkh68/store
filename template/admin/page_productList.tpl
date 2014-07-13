
    <div class="content">
        <div class="content-header">
            <h2 class="content-title rtl"><i class="glyphicon glyphicon-shopping-cart"></i> لیست محصولات</h2>
        </div><!--/content-header -->

        <div class="content-body">
        <!-- APP CONTENT
        ================================================== -->
        <!-- DASHBOARD
        ================================================== -->
        <!-- Dashboard  -->
        <div id="error-placement"></div>

        <div class="row">
            <div class="col-md-12">
                <div id="panel-tblbasic2" class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="panel-actions">
                            <button data-expand="#panel-tblbasic2" title="گسترش فضا" class="btn-panel">
                                <i class="fa fa-expand"></i>
                            </button>
                            <button data-collapse="#panel-tblbasic2" title="بستن" class="btn-panel">
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </div><!-- /panel-actions -->
                        <h3 class="panel-title rtl">لیست محصولات </h3>
                    </div><!-- /panel-heading -->

                    <div class="panel-body rtl">
                        <?php
                            if(isset($_SESSION['pageMessage']) && !empty($_SESSION['pageMessage']['message'])) {
                        ?>
                            <div class="callout callout-<?php echo $_SESSION['pageMessage']['type']?> callout-left fade in rtl">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><?php echo $_SESSION['pageMessage']['title']?></h4>
                                <p><?php echo $_SESSION['pageMessage']['message']?></p>
                            </div>
                        <?php
                                $_SESSION['pageMessage'] = "";
                                unset($_SESSION['pageMessage']);
                            }
                        ?>
                        <div class="table-responsive table-responsive-datatables rtl">
                            <table class="tablesorter table table-hover table-bordered rtl">
                                <thead>
                                    <tr>
                                        <th>شماره</th>
                                        <th>نام</th>
                                        <th>برند</th>
                                        <th>سایز</th>
                                        <th>قیمت</th>
                                        <th>تعداد</th>
                                        <th>رنگ</th>
                                        <th>وضعیت</th>
                                        <th>نوع دسته بندی</th>
                                        <th>تاریخ ایجاد شده</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead><!--/thead-->

                                <tbody>

                                <?php
                                if(!empty($temp['productList'])) {
                                    $cnt = 1;
                                    foreach($temp['productList'] as $row) {
                                ?>
                                    <tr>
                                        <td><? echo $cnt;?></td>
                                        <td><? echo $row->name;?></td>
                                        <td><? echo $row->brand_name;?></td>
                                        <td><? echo $row->size;?></td>
                                        <td><? echo $row->price;?></td>
                                        <td><? echo $row->quantity;?></td>
                                        <td><? echo $row->color;?></td>
                                        <td>
                                            <?php
                                            if($row->status == 1) {

                                                ?>
                                            <div class="text-center">
                                                <span class="label label-success text-center text-1 rtl">موجود</span>
                                            </div>
                                            <?php
                                            } else {
                                                ?>
                                            <div class="text-center">
                                                <span class="label label-danger text-center text-1 rtl">نا موجود</span>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><? echo $row->type_name;?></td>
                                        <td><? echo $row->creation_date;?></td>
                                        <td class="text-center">
                                            <a href="<?php RELA_DIR; ?>users.php?action=delUser&uid=<?php echo $row->product_id; ?>" rel="tooltip" class="glyphicon glyphicon-trash" title="حذف کاربر" style="margin-right: .5em;"></a>
                                            <a href="<?php RELA_DIR; ?>users.php?action=editUser&uid=<?php echo $row->product_id; ?>" rel="tooltip" class="glyphicon glyphicon-pencil" title="ویرایش کاربر"></a>
                                        </td>
                                    </tr>
                                <?php
                                        $cnt++;
                                    }
                                } else {
                                ?>
                                    <tr><td colspan="11" class="text-center">هیچ داده ای یافت نشد</td></tr>
                                <?php
                                }
                                ?>
                                </tbody><!--/tbody-->
                                <tfoot>
                                    <tr>
                                        <th colspan="11" class="ts-pager form-horizontal">
                                            <button type="button" class="btn btn-default btn-sm first"><i class="icon-step-backward fa fa-angle-double-left"></i></button>
                                            <button type="button" class="btn btn-default btn-sm prev"><i class="icon-arrow-left fa fa-angle-left"></i></button>
                                            <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                                            <button type="button" class="btn btn-default btn-sm next"><i class="icon-arrow-right fa fa-angle-right"></i></button>
                                            <button type="button" class="btn btn-default btn-sm last"><i class="icon-step-forward fa fa-angle-double-right"></i></button>
                                            <select class="pagesize input-sm" title="Select page size">
                                                <option value="5" selected="selected">5</option>
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                            </select>
                                            <select class="pagenum input-sm" title="Select page number"></select>
                                        </th>
                                    </tr>
                                </tfoot><!--/tfoot-->
                            </table><!--/table tools-->
                        </div><!--/table-responsive-->
                    </div><!-- /panel-body -->
                </div>
            </div><!--/cols-->
        </div>

    </div><!--/content -->
    <script>
        $(function(){
            setTimeout(function(){
                $('.callout').fadeOut('fast').remove();
            },5000);
        });
    </script>