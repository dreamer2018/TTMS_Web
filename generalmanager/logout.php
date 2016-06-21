<?php
/**
 * Created by PhpStorm.
 * User: zhoupan
 * Date: 6/21/16
 * Time: 10:12 PM
 */
session_start();
session_destroy();
//为使框架整个页面跳转到登陆页
echo "<script>alert('已经退出登陆');parent.location.href='../../login.html';</script>";