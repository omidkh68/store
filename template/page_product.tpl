<!-- seperator -->
<div class="row xsmallSpace"></div>

<div class="row">
    <div id="content" class="col-sm-12 col-md-12 pull-left">
        <div class="row product-info">
            <?php
            if(isset($temp)) {
            foreach($temp['products'] as $row) {
                $color = "";
                $status = "موجود";
                $statusColor = "green";
                $pic = "";
                $picTemp = "";
                if($row->status == 0) {
                    $status = "نا موجود";
                    $statusColor = "red";
                }
                $colorTemp = explode("-",$row->color);
                foreach($colorTemp as $key=>$value) {
                    $color .= $value."<br>";
                }
                if($row->pic_name) {
                    $picTemp = explode("///",$row->pic_name);
                }
                if($picTemp != "") {
            ?>
            <div class="col-sm-6 col-md-5 image-container pull-left">

                <div id="custom_carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php
                        $cnt = 1;
                        foreach($picTemp as $key=>$value) {
                        ?>
                        <div class="item <?php if($cnt == 1) echo "active";?>">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12"><img src="<?php echo RELA_DIR; ?>template/product_image/<?php echo $row->type; ?>/<?php echo $value; ?>" class="img-responsive center-block"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $cnt++;
                        }
                        ?>
                        <!-- End Item -->
                    </div>
                    <!-- End Carousel Inner -->
                    <div class="controls">
                        <ul class="nav">
                            <?php
                            $cnt = 0;
                            foreach($picTemp as $key=>$value) {
                                ?>
                                <li data-target="#custom_carousel" data-slide-to="<?php echo $cnt; ?>" <?php if($cnt == 0) echo 'class="active"';?>><a href="#"><img class="center-block" src="<?php echo RELA_DIR; ?>template/product_image/<?php echo $row->type; ?>/<?php echo $value; ?>"></a></li>
                                <?php
                                $cnt++;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- End Carousel -->
            </div>
            <?php } ?>

            <div class="col-sm-6 col-md-6 pull-right rtl">
                <!-- seperator -->
                <div class="row xsmallSpace"></div>

                <h1 class="ltr"><?php echo $row->name ?></h1>

                <div class="description text-4">
                    <span class="pull-right">برند :</span> <a href="http://www.<?php echo $row->brand; ?>.com" target="_blank"><?php echo $row->brand; ?></a><br>
                    <span class="pull-right">وضعیت محصول : </span><span class="status <?php echo $statusColor; ?>"><?php echo $status; ?></span><br>
                    <span class="pull-right">قیمت : </span><div class="price"><?php echo $row->price; ?> تومان</div>
                    <span class="pull-right">دسته بندی :‌</span><?php echo $row->type; ?><br>
                    <span class="pull-right">رنگ : </span><br><?php echo $color; ?>
                </div>
            <?php
            if(isset($_SESSION['userType']) && $_SESSION['userType'] == "normal") {
            ?>
                <strong class="text-3">تعداد :‌</strong>
                <br>
                <form method="post" action="<?php echo RELA_DIR; ?>page/basket.php">
                    <input type="hidden" name="action" id="action" value="addToBasket">
                    <input type="hidden" name="proID" id="proID" value="<?php echo $row->id; ?>">
                    <div class="input-group" id="quantityHolder" style="max-width: 100px;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-danger action_btn" data-type="dec" tabindex="-1">-</button>
                        </div>
                        <input type="text" name="quantity" id="quantity" class="form-control text-center onlyNum quantity" value="1" autocomplete="off" spellcheck="false">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-info action_btn" data-type="inc" tabindex="-1">+</button>
                        </div>
                    </div>
                    <br><br>
                <?php
                if(isset($_SESSION['userName']) && !empty($_SESSION['userName'])) {
                ?>
                    <?php if($row->status == 1) {?>
                    <button type="submit" class="btn btn-success">اضافه کردن به سبد خرید</button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-success disabled">اضافه کردن به سبد خرید</button>
                    <?php } ?>
                <?php
                } else {
                ?>
                    <a href="<?php RELA_DIR; ?>login.php" class="linked btn btn-link text-24 text-bold text-danger">برای استفاده از امکانات سایت لطفا عضو شوید<i class="icon icon-link pull-right"></i></a>
                <?php
                }
                ?>
                </form>

            <?php
            } else if(!isset($_SESSION['userType'])) {
            ?>
            <a href="<?php RELA_DIR; ?>login.php" class="linked btn btn-link text-24 text-bold text-danger">برای استفاده از امکانات سایت لطفا عضو شوید<i class="icon icon-link pull-right"></i></a>
            <?php
            }
            }
            }
            ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.controls .nav li:first-child').remove();
        $('.controls .nav li:first-child').addClass('active');
        $('.carousel-inner .item:first-child').remove();
        $('.carousel-inner .item:first-child').addClass('active');
    });
</script>