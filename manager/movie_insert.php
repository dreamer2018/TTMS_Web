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


<!-- 网页头部 -->
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
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
<!-- 头部结束-->


<div class="container clearfix">
    <!-- 网页菜单栏-->
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="studio_manager.php"><i class="icon-font">&#xe044;</i>影厅管理</a></li>
                        <li><a href="movie_manager.php"><i class="icon-font">&#xe034;</i>影片管理</a></li>
                        <li><a href="seat_manager.php"><i class="icon-font">&#xe063;</i>座位管理</a></li>
                        <li><a href="schedule_insert.php"><i class="icon-font">&#xe014;</i>演出计划管理</a></li>
                        <li><a href="managerStatistic.php"><i class="icon-font">&#xe065;</i>财务管理</a></li>
                        <li><a href="managerStatistic.php"><i class="icon-font">&#xe042;</i>票房统计</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="employee_manager.php"><i class="icon-font">&#xe017;</i>人事管理</a></li>
                        <li><a href="change_passwd.html"><i class="icon-font">&#xe017;</i>密码重置</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- 菜单栏结束-->

    
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span
                    class="crumb-step">&gt;</span><a class="crumb-name" href="movie_manager.php">影片管理</a><span
                    class="crumb-step">&gt;</span><span>添加影片</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="movie_insert.php" method="post" id="myform" name="myform">
                    <table class="insert-tab" width="100%" id="fid" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <th width="120"><i class="require-red">*</i>影片类型：</th>
                            <td>
                                <select name="type" id="type" class="required">
                                    <?php
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
                                    $query = "select id,type from type;";
                                    $result = $connect->query($query);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value=" . $row["id"] . ">" . $row["type"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th width="120"><i class="require-red">*</i>影片等级：</th>
                            <td>
                                <select name="level" id="catid" class="required">
                                    <?php

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
                                    $query = "select id,type from level ;";
                                    $result = $connect->query($query);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value=" . $row["id"] . ">" . $row["type"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th width="120"><i class="require-red">*</i>语言：</th>
                            <td>
                                <select name="lang" id="lang" class="required">
                                    <?php

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
                                    $query = "select id,type from lang ;";
                                    $result = $connect->query($query);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value=" . $row["id"] . ">" . $row["type"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>影片名称：</th>
                            <td>
                                <input class="common-text required" id="title" name="name" size="20" value=""
                                       type="text">
                            </td>
                        </tr>

                        <tr>
                            <th><i class="require-red">*</i>剧目图片url：</th>
                            <td>
                                <input class="common-text required-red" id="Introduction" name="image_url" size="30"
                                       value="" type="text">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>简介：</th>
                            <td>
                                <input class="common-text required-red" name="introd" size="50"
                                       value="" type="text">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>评分：</th>
                            <td>
                                <input class="common-text required-red" id="Score" name="score" size="10" value=""
                                       type="text">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>时间：</th>
                            <td>
                                <input class="common-text required-red" id="time" name="length" size="20" value=""
                                       type="text">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>价格：</th>
                            <td>
                                <input class="common-text required-red" id="price" name="price" size="10" value=""
                                       type="text">
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <br/>
                    <input id="subid" class="btn btn-primary btn6 mr10" value="提交" type="submit"
                           style="margin-left:6%;">
                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button" style="margin-left:3%">
                    <br/>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-content" id="fid">
                <?php
                if (isset($_POST['type'])) {

                    $type = $_POST['type'];
                    $level = $_POST['level'];
                    $lang = $_POST['lang'];
                    $name = $_POST['name'];
                    $image_url = $_POST['image_url'];
                    $introd = $_POST['introd'];
                    $score = $_POST['score'];
                    $length = $_POST['length'];
                    $price = $_POST['price'];


                    $sign = 1;  //信息正确性标志

                    /*
                     * 对输入信息进行验证
                     */
                    if ($score <= 0 or $score > 10) {
                        echo "<p>评分只能在0到10之间！</p><br/>";
                        $sign = 0;
                    }
                    if (strlen($name) < 0 or strlen($name) > 40) {
                        echo "<p>剧名过长或为空！</p><br/>";
                        $sign = 0;
                    }
                    if (strlen($image_url) < 0 or strlen($image_url) > 100) {
                        echo "<p>剧目图片url过长或为空！</p><br/>";
                        $sign = 0;
                    }
                    if ($length <= 0) {
                        echo "<p>剧目长度输入不合法！</p><br/>";
                        $sign = 0;
                    }
                    if (strlen($introd) < 0 or strlen($introd) > 1000) {
                        echo "<p>剧目简介过长或为空！</p><br/>";
                        $sign = 0;
                    }
                    if ($price < 0) {
                        echo "<p>票价输入不合法！</p><br/>";
                        $sign = 0;
                    }

                    if ($sign) {

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


                        $status = 0;
                        $query = "insert into play ( name,type_id,lang_id,level_id,score,Introduction,image_url,length,price,status ) values (\"" . $name . "\"," . $type . "," . $lang . "," . $level . "," . $score . ",\"" . $introd . "\",\"" . $image_url . "\"," . $length . "," . $price . "," . $status . ");";
                        $result = $connect->query($query);
                        if ($result) {

                            $query = "select type from type where id =" . $type . ";";
                            $result2 = $connect->query($query);
                            $row2 = $result2->fetch_array();
                            $query = "select type from lang where id =" . $type . ";";
                            $result3 = $connect->query($query);
                            $row3 = $result3->fetch_array();
                            $query = "select type from level where id =" . $type . ";";
                            $result4 = $connect->query($query);
                            $row4 = $result4->fetch_array();

                            echo "<table class=\"result-tab\" width=\"100%\" id=\"tableid\" cellpadding=\"0\" cellspacing=\"0\">";
                            echo "<tr>";
                            echo "<th>影片类型</th>";
                            echo "<th>等级</th>";
                            echo "<th>语言</th>";
                            echo "<th>影片名称</th>";
                            echo "<th>图片url</th>";
                            echo "<th>简介</th>";
                            echo "<th>评分</th>";
                            echo "<th>时长</th>";
                            echo "<th>价格</th>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>" . $row2['type'] . "</td>";
                            echo "<td>" . $row3['type'] . "</td>";
                            echo "<td>" . $row4['type'] . "</td>";
                            echo "<td>" . $name . "</td>";
                            echo "<td>" . $image_url . "</td>";
                            echo "<td>" . $introd . "</td>";
                            echo "<td>" . $score . "</td>";
                            echo "<td>" . $length . "</td>";
                            echo "<td>" . $price . "</td>";
                            echo "</tr>";
                            echo "</table>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>