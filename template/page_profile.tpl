<!-- seperator -->
<div class="row xsmallSpace"></div>

<div class="row">
    <div id="content" class="col-sm-12 col-md-12 pull-left">
        <div class="row product-info">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <form action="<?php echo RELA_DIR; ?>page/basket.php" method="post">
                    <input type="hidden" name="action" id="action" value="confirm">
                    <div class="table-responsive">
                    <?php
                    if(isset($temp['products'])) {
                        //echo "<pre>";print_r($temp['products']);die();
                        $count = count($temp['products']);
                        if($count) {
                    ?>
                        <table class="table table-hover rtl text-right">
                            <thead>
                                <tr>
                                    <th class="text-right text-13">محصول</th>
                                    <th class="text-right text-13">تعداد</th>
                                    <th class="text-right text-13">قیمت</th>
                                    <th class="text-right text-13">قیمت نهایی</th>
                                    <th class="text-right text-13">وضعیت مکانی</th>
                                    <th class="text-right text-13">وضعیت پرداخت</th>
                                    <th class="text-right text-13">تاریخ خرید</th>
                                    <th class="text-right text-13">تاریخ تحویل به مشتری</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $pic = "";
                            $total = 0;
                            foreach($temp['products'] as $row) {
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
                                            <div class="media-body" style="width: 100%;">
                                                <h4 class="media-heading text-16"><span class="printable"><?php echo $row->name; ?></span><a href="<?php echo RELA_DIR; ?>page/product.php?action=viewProduct&pid=<?php echo $row->pro_id; ?>"><?php echo $row->name; ?></a></h4>
                                                <h5 class="media-heading">کاربر :
                                                    <a href="<?php echo RELA_DIR; ?>page/profile.php"><?php if($row->customer_name != "") {echo $row->customer_name;} else {echo $row->customer_email;}?></a>
                                                    <span class="printable"><?php if($row->customer_name != "") {echo $row->customer_name;} else {echo $row->customer_email;}?></span>
                                                </h5>
                                                <span class="rtl text-16">وضعیت : </span><span class="text-success text-16"><strong>موجود</strong></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center text-16">
                                        <?php echo $row->quantity; ?>
                                    </td>
                                    <td class="text-right text-16"><span class="pro_price"><?php echo $row->price; ?></span> تومان</td>
                                    <td class="text-right text-16"><span class="pro_quantityPrice"><?php echo $row->quantity*$row->price; ?></span> تومان</td>
                                    <td class="text-center text-16"><?php if($row->status == 0) {echo "انبار";} else {echo "ارسال شده";} ?></td>
                                    <td class="text-center text-16"><?php if($row->payment_status == 0) {echo "پرداخت نشده";} else {echo "پرداخت شده";} ?></td>
                                    <td class="text-center text-16"><?php echo $row->order_date; ?></td>
                                    <td class="text-center text-16"><?php echo $row->delivery_date; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><h5 class="text-right">جمع مبالغ محصولات : </h5></td>
                                    <td colspan="2" class="text-right"><h5><strong class="final_totalPrice" style="font-weight: normal;"><?php echo $total; ?></strong> تومان</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><h5 class="text-right">هزینه پستی :‌</h5></td>
                                    <td colspan="2" class="text-right"><h5><strong class="post_price" style="font-weight: normal;">3000</strong> تومان</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><h5 class="text-right">ملبغ نهایی :‌</h5></td>
                                    <td colspan="2" class="text-right"><h5><strong class="finalCash" style="font-weight: normal;"><?php echo $total+3000; ?></strong> تومان</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="8">
                                        <button type="button" class="btn btn-danger text-bold" onclick="javascript:window.print();">
                                            <span class="glyphicon glyphicon-print"></span>  چاپ فاکتور
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
        },5000);

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