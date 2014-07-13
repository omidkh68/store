<!-- seperator -->
<div class="row xsmallSpace"></div>

<div class="row">
    <div id="content" class="col-sm-12 col-md-9 pull-left">
        <div class="row">
            <?php
            if(isset($temp)) {
                $count = count($temp['products']);
                if($count > 0) {
                    foreach($temp['products'] as $row) {
                        $pic = "";
                        $picTemp = explode("///",$row->pic_name);
                        $cnt = 1;
                        foreach($picTemp as $key=>$value) {
                            $pic = $value;
                            if($cnt == 2) {
                                break;
                            }
                            $cnt++;
                        }
                        ?>
            <div class="col-xs-6 col-sm-4 col-md-4">
                <div class="thumbnail rainbow">
                    <aside><img class="img-rounded" src=" <?php echo RELA_DIR; ?>template/product_image/<?php echo $row->type; ?>/<?php echo $pic; ?>"></aside>
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
                } else {
                ?>
            <div class="col-md-8 center-block">
                <!-- seperator -->
                <div class="row mediumSpace"></div>
                <div class="alert alert-warning text-center">
                    <strong class="text-16">هیچ محصولی با این نوع ثبت نشده است</strong>
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
        <h4 class="rtl">دسته بندی محصولات</h4>
        <div class="divider-content divider-content-sm"></div>
        <!-- seperator -->
        <div class="row xsmallSpace"></div>

        <div class="row">
            <div class="col-md-12 center-block">
                <ul class="list-group">
                <?php
                if(isset($temp)) {
                    foreach($temp['cat'] as $row) {
                ?>
                    <li class="list-group-item"><a href="<?php echo RELA_DIR; ?>page/product.php?action=viewProduct&catid=<?php echo $row->type_id; ?>"><?php echo $row->type_name; ?><span class="badge badge-warning text-inverse"><?php echo $row->count; ?></span></a></li>
                <?php
                    }
                }
                ?>
                </ul>
            </div>
        </div>

    </div>
</div>