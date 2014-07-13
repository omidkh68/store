<!-- seperator -->
<div class="row xsmallSpace"></div>

<div class="row">
    <div id="content" class="col-sm-12 col-md-12 pull-left">
        <?php
        if(isset($_SESSION['basketExist']) && !empty($_SESSION['basketExist'])) {
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissable rtl">
                    <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>کاربر عزیز</h4>
                    <p class="text-16">محصولی که انتخاب کرده اید در سبد خرید شما موجود است لطفا سبد خرید را ملاحظه فرمایید.</p>
                    <p><a class="btn btn-link text-bold text-inverse">یا به صفحه محصولات مراجعه فرمایید.</a> <a class="btn btn-info text-bold" href="<?php echo RELA_DIR; ?>page/product.php">صفحه محصولات</a> </p>
                </div>
            </div>
        </div>
        <?php
            $_SESSION['basketExist'] = "";
            unset($_SESSION['basketExist']);
        } else if(isset($_SESSION['basketDelete']) && !empty($_SESSION['basketDelete'])) {
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissable rtl">
                    <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>پیغام موفق</h4>
                    <p class="text-16">محصول مورد نظر با موفقیت از سبد خرید شما حذف شد</p>
                </div>
            </div>
        </div>
        <?php
            $_SESSION['basketDelete'] = "";
            unset($_SESSION['basketDelete']);
        }

        // if confirm purchasing is successfully then show the message

        if(isset($_SESSION['successTransaction']) && !empty($_SESSION['successTransaction'])) {
        ?>
        <!--  if confirm purchasing is successfully then show the message  -->
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissable rtl">
                    <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>پیغام موفق</h4>
                    <p class="text-16">
                        کاربر گرامی خرید شما با موفقیت انجام شد.<br>
                        شما می توانید از طریق منوی پروفایل خود نحوه دریافت و موقعیت مکانی جنس خریداری شده خود را پیگیری نمایید با تشکر از حسن انتخاب شنا.
                    </p>
                </div>
            </div>
        </div>
        <?php
            $_SESSION['successTransaction'] = "";
            unset($_SESSION['successTransaction']);
        }
        ?>

        <div class="row product-info">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <form action="<?php echo RELA_DIR; ?>page/basket.php" method="post">
                    <input type="hidden" name="action" id="action" value="confirm">
                    <div class="table-responsive">
                    <?php
                    if(isset($temp['basket'])) {
                        //echo "<pre>";print_r($temp['basket']);die();
                        $count = count($temp['basket']);
                        if($count) {
                    ?>
                        <table class="table table-hover rtl text-right">
                            <thead>
                                <tr>
                                    <th class="text-right text-13">محصول</th>
                                    <th class="text-right text-13">تعداد</th>
                                    <th class="text-right text-13">قیمت</th>
                                    <th class="text-right text-13">قیمت نهایی</th>
                                    <th class="text-right text-13">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $pic = "";
                            $total = 0;
                            foreach($temp['basket'] as $row) {
                                $pic = "";
                                $picTemp = explode("///",$row->pic_name);
                                foreach($picTemp as $key=>$value) {
                                    $pic = $value;
                                }
                                $total += ($row->quantity*$row->price);
                            ?>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <a class="thumbnail pull-right" href="<?php echo RELA_DIR; ?>page/product.php?action=viewProduct&pid=<?php echo $row->pro_id; ?>"> <img class="media-object" src="<?php echo RELA_DIR; ?>template/product_image/<?php echo $row->type; ?>/<?php echo $pic; ?>" style="max-width: 100px !important;height: auto;max-height: inherit;min-height: inherit !important;"> </a>
                                            <div class="row xxsmallSpace"></div>
                                            <div class="media-body">
                                                <h4 class="media-heading text-16"><span class="printable"><?php echo $row->name; ?></span><a href="<?php echo RELA_DIR; ?>page/product.php?action=viewProduct&pid=<?php echo $row->pro_id; ?>"><?php echo $row->name; ?></a></h4>
                                                <h5 class="media-heading">کاربر :
                                                    <a href="#"><?php if($row->customer_name != "") {echo $row->customer_name;} else {echo $row->customer_email;}?></a>
                                                    <span class="printable"><?php if($row->customer_name != "") {echo $row->customer_name;} else {echo $row->customer_email;}?></span>
                                                </h5>
                                                <span class="rtl text-16">وضعیت : </span><span class="text-success text-16"><strong>موجود</strong></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="input-group" id="quantityHolder" style="max-width: 100px;">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-danger action_btn" data-type="dec" tabindex="-1">-</button>
                                            </div>
                                            <input type="text" name="prod[<?php echo $row->pro_id; ?>]" class="form-control text-center onlyNum quantity" value="<?php echo $row->quantity; ?>" autocomplete="off" spellcheck="false">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-info action_btn" data-type="inc" tabindex="-1">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right text-16"><span class="pro_price"><?php echo $row->price; ?></span> تومان</td>
                                    <td class="text-right text-16"><span class="pro_quantityPrice"><?php echo $row->quantity*$row->price; ?></span> تومان</td>
                                    <td>
                                        <a href="<?php echo RELA_DIR; ?>page/basket.php?action=delPro&bid=<?php echo $row->id; ?>"><i class="icon icon-trash-1 text-24 text-danger"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                                <tr>
                                    <td colspan="3"></td>
                                    <td><h5 class="text-right">جمع مبالغ محصولات : </h5></td>
                                    <td class="text-right"><h5><strong class="final_totalPrice"><?php echo $total; ?></strong> تومان</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td><h5 class="text-right">هزینه پستی :‌</h5></td>
                                    <td class="text-right"><h5><strong class="post_price">3000</strong> تومان</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td><h5 class="text-right">ملبغ نهایی :‌</h5></td>
                                    <td class="text-right"><h5><strong class="finalCash"><?php echo $total+3000; ?></strong> تومان</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <button type="button" class="btn btn-danger text-bold" onclick="javascript:window.print();">
                                            <span class="glyphicon glyphicon-print"></span>  چاپ فاکتور
                                        </button>
                                    </td>
                                    <td>
                                        <a href="<?php echo RELA_DIR; ?>page/product.php" class="btn btn-default text-bold">
                                            <span class="glyphicon glyphicon-shopping-cart"></span> ادامه خرید
                                        </a>
                                        <button type="submit" name="confirm" id="confirm" class="btn btn-success">
                                            <span class="glyphicon glyphicon-check"></span> تأیید خرید
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
                <?php
                    } else {
                ?>
                <!-- seperator -->
                <div class="row mediumSpace"></div>
                <div class="alert alert-warning text-center">
                    <strong class="text-16">سبد خرید شما خالی است</strong>
                </div>
            <?php
                }
            } else { ?>
                <!-- seperator -->
                <div class="row mediumSpace"></div>
                <div class="alert alert-warning text-center">
                    <strong class="text-16">سبد خرید شما خالی است</strong>
                </div>
            <?php
            }
            ?>
            </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        setTimeout(function(){
            $('.alert-dismissable').fadeOut('slow');
        },8000);

        function factorTotal()
        {
            var finalCash = 0,
                finalTotal = 0,
                postPrice = parseInt($('.post_price').text());

            $('.pro_quantityPrice').each(function(){
                finalTotal += parseInt($(this).text());
            });

            finalCash = finalTotal + postPrice;

            $('.final_totalPrice').text(finalTotal);
            $('.finalCash').text(finalCash);
        }
        factorTotal();
    });
</script>