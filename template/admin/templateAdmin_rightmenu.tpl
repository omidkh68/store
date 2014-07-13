<!-- DONT FORGET REPLACE IT FOR PRODUCTION! -->
<aside class="side-left">
    <ul class="sidebar">
        <li>
            <a href="<?php echo RELA_DIR ?>admin/index.php">
                <i class="sidebar-icon fa fa-dashboard"></i>
                <span class="sidebar-text rtl">داشبورد</span>
            </a>
        </li>
        <li class="active">
            <a>
                <i class="sidebar-icon fa fa-user"></i>
                <span class="sidebar-text rtl">کاربران</span>
            </a>
            <ul class="sidebar-child animated fadeInRight">
                <li>
                    <a href="<?php echo RELA_DIR ?>admin/users.php?action=list">
                        <span class="sidebar-text rtl">لیست کاربران</span>
                    </a>
                </li><!--/child-item-->
                <li class="divider"></li>
                <li>
                    <a href="<?php echo RELA_DIR ?>admin/users.php?action=addUser">
                        <span class="sidebar-text rtl">ایجاد کاربر جدید</span>
                    </a>
                </li><!--/child-item-->
            </ul><!--/sidebar-child-->
        </li><!--/sidebar-item-->
        <li>
            <a>
                <i class="sidebar-icon glyphicon glyphicon-shopping-cart"></i>
                <span class="sidebar-text rtl">محصولات</span>
            </a>
            <ul class="sidebar-child animated fadeInRight">
                <li>
                    <a href="<?php echo RELA_DIR ?>admin/products.php?action=list">
                        <span class="sidebar-text rtl">لیست محصولات</span>
                    </a>
                </li><!--/child-item-->
                <li class="divider"></li>
                <li>
                    <a href="<?php echo RELA_DIR ?>admin/products.php?action=addProduct">
                        <span class="sidebar-text rtl">اضافه کردن محصول جدید</span>
                    </a>
                </li><!--/child-item-->
            </ul><!--/sidebar-child-->
        </li><!--/sidebar-item-->
        <li>
            <a>
                <i class="sidebar-icon glyphicon glyphicon-tags"></i>
                <span class="sidebar-text rtl">برند ها</span>
            </a>
            <ul class="sidebar-child animated fadeInRight">
                <li>
                    <a href="<?php echo RELA_DIR ?>admin/brands.php?action=list">
                        <span class="sidebar-text rtl">لیست برند ها</span>
                    </a>
                </li><!--/child-item-->
                <li class="divider"></li>
                <li>
                    <a href="<?php echo RELA_DIR ?>admin/brands.php?action=addBrand">
                        <span class="sidebar-text rtl">اضافه کردن برند جدید</span>
                    </a>
                </li><!--/child-item-->
            </ul><!--/sidebar-child-->
        </li><!--/sidebar-item-->
        <li>
            <a>
                <i class="sidebar-icon fa fa-files-o"></i>
                <span class="sidebar-text rtl">گزارش‌ها</span>
            </a>
            <ul class="sidebar-child animated fadeInRight">
                <li>
                    <a href="<?=RELA_DIR?>admin/reports.php">
                        <span class="sidebar-text rtl">کاربران فعال</span>
                    </a>
                </li><!--/child-item-->
                <li class="divider"></li>
                <li>
                    <a href="<?=RELA_DIR?>admin/reports.php?action=userActivity">
                        <span class="sidebar-text rtl">فعال ترین کاربر</span>
                    </a>
                </li><!--/child-item-->
                <li class="divider"></li>
                <li>
                    <a href="<?php echo RELA_DIR ?>admin/report.php?action=userOnline">
                        <span class="sidebar-text rtl">کاربران آنلاین</span>
                    </a>
                </li><!--/child-item-->
                <li class="divider"></li>
                <li>
                    <a href="<?=RELA_DIR?>admin/report.php?action=maxSoldProduct">
                        <span class="sidebar-text rtl">بیشترین محصول خریداری شده</span>
                    </a>
                </li><!--/child-item-->
                <li class="divider"></li>
                <li>
                    <a href="<?php echo RELA_DIR ?>admin/report.php?action=productExist">
                        <span class="sidebar-text rtl">محصولات موجود</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>