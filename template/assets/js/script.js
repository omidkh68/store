$(document).ready(function () {

    $(this).ajaxStart(function(){
        $('.loading').fadeIn(300);
    });
    $(this).ajaxStop(function() {
        $('.loading').fadeOut(300);
    });

    $.centerizer2 = function (element, position) {
        var ww = $(window).width(),
            ew = $(element).width(),
            subtractw = ww - ew,
            devidew = subtractw / 2;

        if (position != "free") {
            $(element).css('left', devidew + 'px');
        } else {
            $(element).css('margin-left', devidew + 'px');
        }
    };

    /* Show Alert When something happend */
    var show_alert = function (text, mode) {
        $("body").animate({ scrollTop: "0px" },100);
        $('div.msgBox').remove();
        var alert_box = $('<div></div>'),
            content = $('<p>');
        alert_box.addClass('msgBox free radiusBottom');

        switch (mode) {
            case 'warning' :
            {
                alert_box.addClass('msgBox-warning');
                content.addClass('alert-content-warning');
                break;
            }
            case 'success' :
            {
                alert_box.addClass('msgBox-success');
                content.addClass('alert-content-success');
                break;
            }
        }
        content.addClass('text-center-align');
        content.text(text);
        alert_box.append(content);
        $('html').prepend(alert_box);
        $.centerizer2($(alert_box));
        alert_box.animate({
            top: '0'
        }, 400, 'easeOutExpo');
        setTimeout(function () {
            alert_box.animate({
                top: '-200px'
            }, 400, 'easeOutCubic', function () {
                $(this).remove()
            })
        }, 6000);
    };

    // define bootstrap select
    if($('select').length) {
        $('select').selectpicker();
    }

    // define date picker
    if($('.datePicker').length) {
        $('.datePicker').pDatepicker({
            onSelect : function() {
                this.hide();
            },
            onHide : function() {
                $('.datePicker').blur();
            }
        });
    }

    // input must be just enter number
    $('input[type="tel"].onlyNum,input[type="text"].onlyNum').keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 13) {
            var self = $(this);
            //display error message
            $(self).addClass('border-danger');
            return false;
        }
    });

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

    // add or remove quantity in product detail
    $('.action_btn').bind('click',function(e){
        e.preventDefault();
        var self = $(this),
            sum = 0,
            type = $(self).data('type'),
            input = $(self).parents('.input-group').find('.quantity'),
            quantity = parseInt(input.val()),
            price = parseInt($(self).closest('tr').find('.pro_price').text()),
            total = $(self).closest('tr').find('.pro_quantityPrice');

        if(type == 'inc') {
            if(quantity < 20) {
                quantity++;
            }
        } else if(type == 'dec') {
            if(quantity > 1) {
                quantity--;
            } else {
                input.val(1);
                return false;
            }
        }
        input.val(quantity);
        sum = price * quantity;
        var finalTotal = price * 20;
        if(isNaN(sum)) {
            total.text(price);
        } else {
            if(total > finalTotal) {
                total.text(finalTotal);
            } else {
                total.text(sum);
            }
        }

        factorTotal();
    });

    $('.quantity').on('change',function(){
        var val = parseInt($(this).val()),
            sum = 0,
            price = parseInt($(this).closest('tr').find('.pro_price').text()),
            total = $(this).closest('tr').find('.pro_quantityPrice');
        if(val < 1) {
            $(this).val(1);
        }
        if(val > 20) {
            $(this).val(20);
        }
        if(val == "") {
            $(this).val(1);
        }
        sum = price * val;
        var finalTotal = price * 20;
        if(isNaN(sum)) {
            total.text(price);
        } else {
            if(total > finalTotal) {
                total.text(finalTotal);
            } else {
                total.text(sum);
            }
        }

        factorTotal();

    }).keyup(function(){
            var val = parseInt($(this).val()),
                sum = 0,
                price = parseInt($(this).closest('tr').find('.pro_price').text()),
                total = $(this).closest('tr').find('.pro_quantityPrice');
            if(val < 1) {
                $(this).val(1);
            }
            if(val > 20) {
                $(this).val(20);
            }
            if($(this).val() == "") {
                $(this).val(1);
            }
            sum = price * val;
            var finalTotal = price * 20;
            if(isNaN(sum)) {
                total.text(price);
            } else {
                if(total > finalTotal) {
                    total.text(finalTotal);
                } else {
                    total.text(sum);
                }
            }
            factorTotal();

    }).blur(function(){
        var val = parseInt($(this).val()),
            sum = 0,
            price = parseInt($(this).closest('tr').find('.pro_price').text()),
            finalTotal = price * 20,
            total = $(this).closest('tr').find('.pro_quantityPrice');
        if(val == 20 || val > 20) {
            total.text(finalTotal);
        }
        factorTotal();
    });

    $('#custom_carousel').on('slide.bs.carousel', function (evt) {
        $('#custom_carousel .controls li.active').removeClass('active');
        $('#custom_carousel .controls li:eq('+$(evt.relatedTarget).index()+')').addClass('active');
    });

});