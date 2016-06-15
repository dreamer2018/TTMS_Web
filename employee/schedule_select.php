<!DOCTYPE html>
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
                <a href="index.html">首页</a>
                <span class="crumb-step">&gt;</span>
                <span class="crumb-name">演出计划查询</span>
            </div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">影片名称:</th>
                            <td>
                                <select name="search-sort" >
                                    <option value="">全部</option>
                                    <option value="19">魔兽</option>
                                    <option value="20">愤怒的小鸟</option>
                                </select>
                            </td>
                            <th width="120">日期:</th>
                            <td>
                                <select name="search-sort" >
                                    <option value="">全部</option>
                                    <option value="19">2016.6.14</option>
                                    <option value="20">2016.6.15</option>
                                </select>
                           
                            <th width="120"></th>
                            <td>
                                <input class="btn btn-primary btn2" name="sub" value="查询" type="submit">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-content" id="fid">
                    <table class="result-tab" width="100%" id="tableid" cellpadding="0" cellspacing="0">
                        <tr>
                            <th class="tc">ID</th>
                           
                            <th>演出厅id</th>
                            <th>剧目id</th>
                            <th>放映时间</th>
                            <th>折扣</th>
                            <th>票价</th>
                        </tr>
                        <tr>
                            <td title="美国队长3">美国队长3</td>
                            <td>IMAX</td>
                            <td>2号厅</td>
                            <td>正在上映</td>
                            <td>5.11 21:11:01-5.11 23:11:01</td>
                            <td>5.11 21:11:01-5.11 23:11:01</td>
                            
                        </tr>
                    </table>
                    <div class="list-page"> 1 条 1/1 页</div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
    <script type="text/javascript">
        function post()
            {
                forPost.action="DestinationPage.aspx";
                forPost.submit();
            }
    </script>
</div>
</body>
</html>