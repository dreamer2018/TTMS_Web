<?php
    require_once "../conf/conf.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>光影人生-影院票务管理系统</title>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/houtai.js"></script>
</head>
<body>

<!--网页头部-->
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <ul class="navbar-list clearfix">
                <li style="font-size:20px; font-weight:bold;">光影人生</li>
                <li style="font-size: 16px;font-style: italic">-影院票务管理系统</li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="logout.php"><i class="icon-font">&#xe059;</i></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- 头部结束 -->

<div class="container clearfix">

    <!-- 网页菜单栏 -->
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="movieStatistics.php"><i class="icon-font">&#xe044;</i>票房统计</a></li>
                        <li><a href="generalmanagerStatistic.php"><i class="icon-font">&#xe034;</i>财务统计</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="employee_manager.php"><i class="icon-font">&#xe017;</i>人事管理</a></li>
                        <li><a href="change_passwd.php"><i class="icon-font">&#xe017;</i>修改密码</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- 菜单栏结束 -->



    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list">
                <i class="icon-font"></i>
                <a href="index.php">首页</a>
                <span class="crumb-step">&gt;</span>
                <span>更改密码</span>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="passwd.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%" id="fid" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <th width="120"><i class="require-red">*</i>原始密码：</th>
                            <td>
                                <input class="common-text required" id="old" name="old_passwd" size="20" value="" type="password">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>新密码：</th>
                            <td>
                                <input class="common-text required" id="new" name="new_passwd" size="20" value="" type="password">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>密码确认：</th>
                            <td>
                                <input class="common-text required" id="confirm" name="confirm_passwd" size="20" value="" type="password">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <br/>
                    <input id="subid" class="btn btn-primary btn6 mr10" value="提交" type="submit" style="margin-left: 6%;">
                    <input class="btn btn6" onclick="self.location='index.php'" value="返回" type="button" style="margin-left: 2%;">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
