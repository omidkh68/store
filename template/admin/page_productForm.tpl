
    <div class="content">
        <div class="content-header">
            <h2 class="content-title rtl"><i class="fa fa-user"></i> اضافه کردن کاربر جدید </h2>
        </div><!--/content-header -->

        <div class="content-body">
        <!-- APP CONTENT
        ================================================== -->
        <!-- DASHBOARD
        ================================================== -->
        <!-- Dashboard  -->
        <div id="error-placement"></div>

        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-8 center-block">
                <div id="panel-tblbasic2" class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-actions">
                            <button data-expand="#panel-tblbasic2" title="گسترش فضا" class="btn-panel">
                                <i class="fa fa-expand"></i>
                            </button>
                            <button data-collapse="#panel-tblbasic2" title="بستن" class="btn-panel">
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </div><!-- /panel-actions -->
                        <h3 class="panel-title rtl">لطفا تمامی مقادیر اجباری با پر نمایید</h3>
                    </div><!-- /panel-heading -->

                    <div class="panel-body">
                        <?php
                        if(isset($temp['productInfo'])) {
                            $email = "";
                            $name = "";
                            $family = "";
                            $age = "";
                            $tel = "";
                            foreach($temp['productInfo'] as $row) {
                                /*$email = $row->email;
                                $name = $row->name;
                                $family = $row->family;
                                $age = $row->age;
                                $tel = $row->phone_number;*/
                            }
                        }
                        ?>
                        <form role="form" data-validate="form" class="form-horizontal form-bordered" novalidate="novalidate" method="post" enctype="multipart/form-data">
                            <?php if(!isset($email)) { ?>
                            <input type="hidden" name="action" value="addProduct">
                            <?php } else { ?>
                            <input type="hidden" name="action" value="editProduct">
                            <?php } ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 control-label rtl pull-right" for="name">نام : </label>
                                        <div class="col-sm-12">
                                            <input type="text" id="name" name="name" class="form-control" required="" autocomplete="off" autofocus="" value="<?php ((isset($name) && !empty($name))?print $name:""); ?>" <? ((isset($email) && !empty($email))?print "disabled":""); ?>>
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 control-label rtl pull-right" for="brand">برند : </label>
                                        <div class="col-sm-12">
                                            <select name="brand" id="brand" data-input="selectboxit" placeholder="برند را انتخاب نمایید">
                                            <?php if(isset($temp['productBrand'])) {
                                                foreach($temp['productBrand'] as $row) {
                                            ?>
                                                <option value="<?php echo $row->brand_id; ?>"><?php echo $row->brand_name; ?></option>
                                            <?php
                                                }
                                            } ?>
                                            </select>
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 control-label rtl pull-right" for="size">سایز های کفش : (با علامت [-] از هم جدا نمایید)</label>
                                        <div class="col-sm-12">
                                            <input type="text" id="size" name="size" class="form-control" autocomplete="off" value="<?php ((isset($name) && !empty($name))?print $name:""); ?>">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 control-label rtl pull-right" for="price">قیمت : </label>
                                        <div class="col-sm-12">
                                            <input type="text" id="price" name="price" class="form-control" autocomplete="off" value="<?php ((isset($family) && !empty($family))?print $family:""); ?>">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 control-label rtl pull-right" for="quantity">تعداد : ‌</label>
                                        <div class="col-sm-12">
                                            <input type="text" id="quantity" name="quantity" class="form-control" autocomplete="off" value="<?php ((isset($age) && !empty($age))?print $age:""); ?>">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 control-label rtl pull-right" for="color">رنگ : (با علامت [-] از هم جدا نمایید)</label>
                                        <div class="col-sm-12">
                                            <input type="tel" id="color" name="color" class="form-control" autocomplete="off" value="<?php ((isset($tel) && !empty($tel))?print $tel:""); ?>">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 control-label rtl pull-right" for="type">نوع دسته بندی محصول : </label>
                                        <div class="col-sm-12">
                                            <select name="type" id="type" data-input="selectboxit" placeholder="نوع دسته بندی را انتخاب نمایید">
                                                <?php if(isset($temp['productType'])) {
                                                    foreach($temp['productType'] as $row) {
                                                        ?>
                                                        <option value="<?php echo $row->type_id; ?>"><?php echo $row->type_name; ?></option>
                                                    <?php
                                                    }
                                                } ?>
                                            </select>
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-12 control-label rtl pull-right" for="pro_pic">انتخاب تصویر : </label>
                                        <div class="col-sm-12">
                                            <div class="fileinput fileinput-new pull-right" data-provides="fileinput">
                                            <span class="btn btn-icon btn-icon-right btn-success btn-file">
                                                <i class="fa fa-picture-o"></i>
                                                <span class="fileinput-new rtl">انتخاب تصویر</span>
                                                <span class="fileinput-exists rtl">تعویض</span>
                                                <input type="file" name="pro_pic[]" id="pro_pic" multiple>
                                            </span>
                                                <span class="fileinput-filename"></span>
                                                <button class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</button>
                                            </div><!-- /fileinput -->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-6 pull-left">
                                            <input class="btn btn-primary rtl" type="submit" value="ثبت محصول">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                            </form>
                    </div><!-- /panel-body -->
                </div>
            </div><!--/cols-->
        </div>

    </div><!--/content -->