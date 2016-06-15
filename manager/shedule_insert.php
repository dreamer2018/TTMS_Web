<?php
    session_start();
    if (!isset($_SESSION["username"]) || !isset($_SESSION["identity"])) {
        die("<h1>非法访问</h1>");
    }
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/houtai.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.html">首页</a></li>
                <li><a href="#" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="#"><i class="icon-font">&#xe014;</a></li>
                <li><a href="#"><i class="icon-font">&#xe018;</a></li>
                <li><a href="#"><i class="icon-font">&#xe059;</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="design.html"><i class="icon-font">&#xe008;</i>影厅管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe005;</i>影片管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe006;</i>座位管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe004;</i>会员管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe012;</i>财务管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe052;</i>票房统计</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe033;</i>广告管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin/design/">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="design.html">影片管理</a><span class="crumb-step">&gt;</span><span>添加影片</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="design.html" method="post" id="myform" name="myform" enctype="multipart/form-data" method="get">
                    <table class="insert-tab" width="100%" id="fid" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <th width="120"><i class="require-red">*</i>演厅id：</th>
                                <td>
                                    <select name="studio_id" id="studio_id" class="required">
                                        <?php
                                            require_once "../../conf/DB_login.php";
                                            /*
                                             * 连接数据库
                                             */
                                            $connect = new mysqli($DB_HOST, $DB_USER, $DB_PASSWD);
                                            /*
                                             * 如果连接失败，则直接结束
                                            */
                                            if (!$connect) {
                                                die("Connect DataBase Error!<br/>");
                                            }

                                            /*
                                             * 选择数据库
                                             */
                                            $select = $connect->select_db($DB_NAME);

                                            $emp_no=$_SESSION["username"];
                                            $query="select theater_id from manager where emp_no = \"".$emp_no."\";"
                                            $result = $connect ->query($query);
                                            while ($row = $result->fetch_array()) {
                                                $theater_id=$row["theater_id"];
                                            }
                                            $query="select (id,name) from studio where theater_id =".$theater_id.";";
                                            $result = $connect ->query($query);
                                            while ($row = $result->fetch_array()) {
                                                echo "<option value=".$row["id"].">".$row["name"]."</option>"
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>  
                            <tr>
                                <th width="120"><i class="require-red">*</i>剧目id：</th>
                                <td>
                                    <select name="play_id" id="play_id" class="required">
                                        <option value="20">1</option>
                                        <option value="19">2</option>
                                        <option value="18">3</option>
                                         <?php
                                            require_once "../../conf/DB_login.php";
                                            /*
                                             * 连接数据库
                                             */
                                            $connect = new mysqli($DB_HOST, $DB_USER, $DB_PASSWD);
                                            /*
                                             * 如果连接失败，则直接结束
                                            */
                                            if (!$connect) {
                                                die("Connect DataBase Error!<br/>");
                                            }

                                            /*
                                             * 选择数据库
                                             */
                                            $select = $connect->select_db($DB_NAME);
                                            $query="select (id,name) from studio ;";
                                            $result = $connect ->query($query);
                                            while ($row = $result->fetch_array()) {
                                                echo "<option value=".$row["id"].">".$row["id"]."(".$row["name"].")</option>"
                                            }
                                        ?>


                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>放映时间：</th>
                                <td>
                                    <input class="common-text required-red" id="time" name="title" size="20" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>折扣：</th>
                                <td>
                                    <input class="common-text required-red" id="price" name="title" size="20" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                 
                                <th><i class="require-red">*</i>价格：</th>
                                <td>
                                    <input class="common-text required" id="price" name="title" size="20" value="" type="text">
                                </td>
                        </tbody></table><br/>
                        <input id="subid" class="btn btn-primary btn6 mr10" value="提交" type="submit" style="margin-left:4%;">
                        <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button" style="margin-left:2%;">         
                </form>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>