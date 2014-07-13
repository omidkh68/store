    <div class="row xsmallSpace"></div>

    <!-- slider container -->
    <div class="row">
        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="5"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="6"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="7"></li>
                </ol>
                <div class="carousel-inner rainbow">
                    <div class="item active"><img src="<?=RELA_DIR ?>template/assets/img/slider1.jpg"></div>
                    <div class="item"><img src="<?=RELA_DIR ?>template/assets/img/slider2.jpg"></div>
                    <div class="item"><img src="<?=RELA_DIR ?>template/assets/img/slider3.jpg"></div>
                    <div class="item"><img src="<?=RELA_DIR ?>template/assets/img/slider4.jpg"></div>
                    <div class="item"><img src="<?=RELA_DIR ?>template/assets/img/slider5.jpg"></div>
                    <div class="item"><img src="<?=RELA_DIR ?>template/assets/img/slider6.jpg"></div>
                    <div class="item"><img src="<?=RELA_DIR ?>template/assets/img/slider7.jpg"></div>
                    <div class="item"><img src="<?=RELA_DIR ?>template/assets/img/slider8.jpg"></div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>

    <!-- seperator -->
    <div class="row xsmallSpace"></div>

    <!-- content and rightMenu -->
    <div class="row">
        <!-- content -->
        <div id="content" class="col-sm-12 col-md-9 pull-left">

            <!-- view some product and introduction -->
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center titleBar jail">
                        <span>آخرین محصولات</span>
                    </h4>

                    <!-- seperator -->
                    <div class="row xsmallSpace"></div>
                </div>

                <?php
                if(isset($temp)) {
                    foreach($temp['products'] as $row) {
                        $pic = "";
                        $picTemp = explode("///",$row->pic_name);
                        $cnt = 1;
                        foreach($picTemp as $key=>$value) {
                            $pic = $value;
                            $cnt++;
                        }
                        ?>
                        <div class="col-xs-6 col-sm-4 col-md-4">
                            <div class="thumbnail rainbow">
                                <aside><img class="img-rounded" src="<?php echo RELA_DIR; ?>template/product_image/<?php echo $row->type; ?>/<?php echo $pic; ?>"></aside>
                                <div class="free moreHolder transition">
                                    <a class="block jail" href="<?php echo RELA_DIR; ?>page/product.php?action=viewProduct&pid=<?php echo $row->id; ?>">
                                        <button type="button" class="btn btn-info jail center-block addToCard">
                                            <i class="glyphicon glyphicon-shopping-cart pull-right"></i>
                                            اطلاعات بیشتر
                                        </button>
                                    </a>
                                </div>
                                <span class="priceHolder jail center-block rtl"><?php echo $row->price; ?><br>هزار<br>تومان</span>
                                <div class="caption text-center">
                                    <h3><?php echo $row->name; ?></h3>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>

        <!-- rightMenu -->
        <div id="rightSideBar" class="col-xs-12 col-sm-12 col-md-3 pull-right">

            <!-- seperator -->
            <div class="row xsmallSpace"></div>

            <div class="row">
                <div class="col-md-10 center-block">
                    <div class="popover right block">
                        <h3 class="popover-title text-4 rtl">درباره نویسنده</h3>
                        <div class="popover-content rtl">
                            <p class="text-2">
                                <a href="http://www.facebook.com/omidkh68" target="_blank">
                                    <img class="pull-right" src="<?=RELA_DIR ?>template/images/omidkh.jpg" alt="omid khosrojerdi">
                                </a>
                                امید خسروجرد هستم، متولد ۱۳۶۸
                                <br>
                                از سال ۸۶ مشغول به فعالیت در زمینه وب هستم و به طراحی و برنامه نویسی وب علاقه دارم
و مهارت در زمینه html، css، javascript، php و jquery دارم.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>