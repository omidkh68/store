
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
            <div class="col-md-6 center-block">
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
                        <form role="form" data-validate="form" class="form-horizontal form-bordered" novalidate="novalidate" method="post">
                            <input type="hidden" name="action" value="addUser">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label rtl pull-right" for="email">ایمیل : (اجباری)</label>
                                        <div class="col-sm-6">
                                            <input type="email" id="email" name="email" class="form-control" required="">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label rtl pull-right" for="password">گذرواژه :‌(اجباری و حداقل ۵ کاراکتر)</label>
                                        <div class="col-sm-6">
                                            <input type="password" id="password" name="password" class="form-control" minlength="5" required="">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label rtl pull-right" for="name">نام : </label>
                                        <div class="col-sm-6">
                                            <input type="text" id="name" name="name" class="form-control" minlength="2">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label rtl pull-right" for="family">نام خانوادگی : </label>
                                        <div class="col-sm-6">
                                            <input type="text" id="family" name="family" class="form-control" minlength="2">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label rtl pull-right" for="age">سن :‌</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="age" name="age" class="form-control" minlength="1">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label rtl pull-right" for="tel">شماره تلفن : </label>
                                        <div class="col-sm-6">
                                            <input type="tel" id="tel" name="tel" class="form-control" minlength="7">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-6 pull-left">
                                            <input class="btn btn-primary rtl" type="submit" value="ثبت کاربر">
                                        </div><!--/cols-->
                                    </div><!--/form-group-->
                                </div>

                            </form>
                    </div><!-- /panel-body -->
                </div>
            </div><!--/cols-->
        </div>

    </div><!--/content -->