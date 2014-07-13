<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Hotspot Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="stilearning">

    <meta http-equiv="x-pjax-version" content="v173">

    <link rel="stylesheet" href="<?=RELA_DIR?>template/admin/css/admin_main.min.css"/>
    <link rel="stylesheet" href="<?=RELA_DIR?>template/admin/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?=RELA_DIR?>template/admin/css/style.css"/>
</head>
<body>

<div id="panel-login" class="panel panel-default sortable-widget-item center-block">
    <div class="panel-heading">
        <h3 class="panel-title rtl">ورود به سیستم مدیریت</h3>
    </div>

    <div class="panel-body">
        <form role="form" class="form-horizontal form-bordered" method="post">
            <input type="hidden" name="action" value="login" />

            <?php
            if(!empty($temp)) {
                ?>
                <div class="alert alert-danger rtl text-2"><?php print_r($temp); ?></div>
            <?php
            }
            ?>

            <div class="form-group has-feedback">

                <label class="col-sm-4 control-label pull-right rtl" for="username">نام کاربری :‌</label>
                <div class="col-sm-8 pull-right">
                    <div class="input-group input-group-in">
                        <span class="input-group-addon text-silver"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" id="email" name="email" class="form-control tt-query" placeholder="username" autocomplete="off" spellcheck="false" autofocus="" dir="auto" required="">
                    </div>
                </div>
            </div>

            <div class="form-group has-feedback">
                <label class="col-sm-4 control-label pull-right rtl" for="password">گذرواژه : </label>
                <div class="col-sm-8 pull-right">
                    <div class="input-group input-group-in">
                        <span class="input-group-addon text-silver"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control tt-query" placeholder="password" autocomplete="off" spellcheck="false" dir="auto" required="">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-5 pull-left">
                    <input class="btn btn-primary btn-block rtl text-2" type="submit" value="ورود">
                </div>
            </div>

        </form>
    </div>

</div>
</body>
</html>