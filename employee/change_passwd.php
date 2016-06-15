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
                <li><a href="#"><i class="icon-font">&#xe014;</i></a></li>
                <li><a href="#"><i class="icon-font">&#xe059;</i></a></li>
            </ul>
        </div>
    </div>
</div>
<!--头部结束-->


<div class="container clearfix">


    <!--网页菜单栏-->
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="booking.html"><i class="icon-font">&#xe044;</i>售票</a></li>
                        <li><a href="return.html"><i class="icon-font">&#xe034;</i>退票</a></li>
                        <li><a href="select.html"><i class="icon-font">&#xe063;</i>影片查询</a></li>
                        <li><a href="schedule_select.html"><i class="icon-font">&#xe014;</i>演出计划查询</a></li>
                        <li><a href="employeeStatistic.html"><i class="icon-font">&#xe065;</i>统计</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="change_passwd.html"><i class="icon-font">&#xe017;</i>更改密码</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--菜单栏结束-->

    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list">
		<i class="icon-font"></i>
		<a href="/jscss/admin/design/">首页</a>
		<span class="crumb-step">&gt;</span>
		<span>更改密码</span>
	   </div>
        </div>
       <div class="result-wrap">
            <div class="result-content">
                <form action="design.html" method="post" id="myform" name="myform" enctype="multipart/form-data" method="get">
                    <table class="insert-tab" width="100%" id="fid" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <th width="120"><i class="require-red">*</i>工号：</th>
                                <td>
                                    <!-- <select name="colId" id="catid" class="required">
                                        <option value="20">2D</option><option value="20">3D</option><option value="19">IMAX</option>
                                    </select> -->
                                    <input class="common-text required" id="title" name="title" size="20" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>原始密码：</th>
                                <td>
                                    <input class="common-text required" id="title" name="title" size="20" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>新密码：</th>
                                <td>
                                   <!--  <select name="colId" id="homeid" class="required">
                                        <option value="20">1号厅</option><option value="20">2号厅</option><option value="19">3号厅</option>
                                    </select> -->
                                    <input class="common-text required" id="title" name="title" size="20" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>确认密码：</th>
                                <td>
                                   <!--  <select name="colId" id="atid" class="required">
                                            <option value="20">正在上映</option><option value="20">即将上映</option>
                                    </select> -->
                                    <input class="common-text required" id="title" name="title" size="20" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <!-- <th>时间：</th>
                                <td>
                                    <input class="common-text required" id="time" name="title" size="20" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>价格：</th>
                                <td>
                                    <input class="common-text required" id="price" name="title" size="20" value="" type="text">
                                </td>
                            </tr> -->
                            <tr>
                                <th></th>
                                <td>
                                    <input id="subid" class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>