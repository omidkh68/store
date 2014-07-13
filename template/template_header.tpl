        <header>
            <div class="row">
                <div class="col-md-12 free topNavbar">
                    <div class="center-block loginContainer">
                        <ul>
                            <?php if(isset($_SESSION['userName']) && !empty($_SESSION['userName'])) {?>
                            <li class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info" style="height: 35px;line-height: 2;" onclick="javascript:window.location = '<?php echo RELA_DIR; ?>page/profile.php';"><?php echo $_SESSION['userName']; ?></button>
                                    <button type="button" class="btn btn-info dropdown-toggle" style="height: 35px;" data-toggle="dropdown">
                                        <span class="caret" style="top: .2em;"></span>
                                        <span class="sr-only"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo RELA_DIR; ?>page/profile.php" class="text-bold">پروفایل کاربری<i class="icon icon-user"></i></a></li>
                                        <li class="divider" style="margin:0;"></li>
                                        <li><a href="<?php echo RELA_DIR; ?>page/logout.php" class="text-bold">خروج از حساب <i class="icon icon-off"></i></a></li>
                                    </ul>
                                </div>
                            </li>
                            <?php } else {?>
                            <li class="pull-right"><a class="transition block text-3" href="<?php echo RELA_DIR; ?>page/login.php"><i class="block icon icon-key"></i>ورود به سیستم</a></li>
                                <li class="pull-right"><a class="transition block text-3" href="<?php echo RELA_DIR; ?>page/register.php"><i class="block icon icon-clipboard-pencil"></i>ثبت نام</a></li>
                            <?php } ?>
                            <li class="pull-right"><a class="transition block text-3" href="<?php echo RELA_DIR; ?>admin/"><i class="block icon icon-user"></i>مدیریت</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-5 pull-right">
                    <div class="logoHolder pull-right">
                        <a href="<?php echo RELA_DIR; ?>"><img src="<?php echo RELA_DIR; ?>template/images/logo.png" title="صفحه اصلی" alt="لوگوی سایت"></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-5 pull-left">
                    <div class="row jail boxContainer unselectable">
                        <div class="col-md-12 box">
                            <i class="block glyphicon glyphicon-headphones pull-left"></i>
                            <span class="block text-2 pull-right">+98 935 2376707</span>
                        </div>
                        <div class="col-md-12 box">
                            <i class="block icon icon-contact-1 pull-left"></i>
                            <span class="block text-2 pull-right">omidkh68[at]gmail[dot]com</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 navigation">
                    <nav class="navbar navbar-inverse" role="navigation">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav pull-right">
                                    <li><a class="transition" href="<?php echo RELA_DIR; ?>">صفحه اصلی</a></li>
                                    <li><a class="transition" href="<?php echo RELA_DIR; ?>page/product.php">محصولات</a></li>
                                    <li><a class="transition" href="<?php echo RELA_DIR; ?>page/basket.php">سبد خرید</a></li>
                                    <li><a class="transition" href="#">ارتباط با ما</a></li>
                                </ul>
                                <?php /* ?>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-search search-only">
                                        <input type="text" class="form-control search-query pull-left">
                                        <span class="pull-left">
                                            <button type="submit" class="btn btn-primary" data-type="last"><i class="icon icon-search-1"></i></button>
                                        </span>
                                    </div>
                                </form>
                                <?php */ ?>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </header>
