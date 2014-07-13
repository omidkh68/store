<?php
include_once("../common/server.inc.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>فروشگاه کفش امید</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="فروشگاه کفش امید">
    <meta name="author" content="فروشگاه کفش امید">

    <link href="<?=RELA_DIR ?>template/images/logo.png" rel="shortcut icon">
    <link href="<?=RELA_DIR ?>template/images/logo.png" rel="bookmark">

    <link rel="stylesheet" href="<?=RELA_DIR?>template/admin/css/admin_main.min.css"/>
    <link rel="stylesheet" href="<?=RELA_DIR?>template/admin/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?=RELA_DIR?>template/admin/css/style.css"/>
</head>
<body>

<div id="panel-login" class="panel panel-default sortable-widget-item center-block">
    <div class="panel-heading">
        <h3 class="panel-title rtl">ثبت نام در سیستم</h3>
    </div>

    <div class="panel-body">
        <?php if(!isset($_SESSION['pageMessage']) && empty($_SESSION['pageMessage'])) { ?>
            <form role="form" class="form-horizontal form-bordered" action="<?php echo RELA_DIR; ?>page/register.php" method="post">
                <input type="hidden" name="action" value="register" />
                <div class="form-group">

                    <label class="col-sm-4 control-label pull-right rtl" for="username">آدرس ایمیل : ‌</label>
                    <div class="col-sm-8 pull-right">
                        <div class="input-group input-group-in">
                            <span class="input-group-addon text-silver"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input type="email" id="username" name="username" class="form-control tt-query" placeholder="email" autocomplete="off" autofocus="" spellcheck="false" dir="auto" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label pull-right rtl" for="password">گذرواژه : </label>
                    <div class="col-sm-8 pull-right">
                        <div class="input-group input-group-in">
                            <span class="input-group-addon text-silver"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control tt-query" placeholder="password" autocomplete="off" spellcheck="false" dir="auto" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label pull-right rtl" for="password">تکرار گذرواژه : </label>
                    <div class="col-sm-8 pull-right">
                        <div class="input-group input-group-in">
                            <span class="input-group-addon text-silver"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" id="repassword" name="repassword" class="form-control tt-query" placeholder="password" autocomplete="off" spellcheck="false" dir="auto" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                        <input class="btn btn-primary btn-block rtl text-2" type="submit" value="ثبت نام">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                        <a href="<?php echo RELA_DIR; ?>page/login.php" class="btn btn-info btn-block text-center rtl text-2">ورود به سیستم</a>
                    </div>
                </div>

            </form>
        <?php } else {?>

            <div class="alert alert-<?php echo $_SESSION['pageMessage']['type']; ?> rtl">
                <h4 class="bordered-bottom border-<?php echo $_SESSION['pageMessage']['type']; ?>"><?php echo $_SESSION['pageMessage']['title']; ?></h4>
                <p><?php echo $_SESSION['pageMessage']['message']; ?></p>
            </div>

            <a href="<?php echo RELA_DIR; ?>page/login.php" class="btn btn-info btn-block text-center rtl text-2">ورود به سیستم</a>

        <?php }
        $_SESSION['pageMessage'] = "";
        unset($_SESSION['pageMessage']);
        ?>
    </div>
</div>
</body>
</html>