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
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span
                    class="crumb-step">&gt;</span><span class="crumb-name">人事管理</span></div>
        </div>
        <div class="result-wrap">

            <div class="result-title">
                <div class="result-list">
                    <a href="add_employee.php"><i class="icon-font"></i>添加</a>
                </div>
            </div>
            <div class="result-content" id="fid">
                <table class="result-tab" width="100%" id="tableid" cellpadding="0" cellspacing="0">
                    <tr>
                        <th class="tc">ID</th>
                        <th class="tc">影院ID</th>
                        <th class="tc">工号</th>
                        <th class="tc">姓名</th>
                        <th class="tc">操作</th>

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
                        $count = 0;
                        $select = $connect->select_db($DB_NAME);
                        if(isset($_POST['mana_id'])){
                            $query = "delete from manager where id = ".$_POST['mana_id'].";";
                            $connect -> query($query);
                        }

                        $query = "select id,emp_no,name,theater_id from manager ;";
                        $result = $connect->query($query);
                        while ($row = $result->fetch_array()) {

                            echo "<tr>";
                            echo "<td class=\"tc\">" . $row['id'] . "</td>";
                            echo "<td class=\"tc\">" . $row['theater_id'] . "</td>";
                            echo "<td class=\"tc\">" . $row['emp_no'] . "</td>";
                            echo "<td class=\"tc\">" . $row['name'] . "</td>";
                            echo "<td class=\"tc\">";
                            echo "<form name=\"myform\" method=\"post\" action=\"employee_manager.php\">";
                            echo "<input type = 'hidden' value ='" . $row['id'] . "'  name = 'mana_id'>";
                            echo "<input  type='submit'  class=\"btn btn-primary btn2\" value='删除' >";
                            echo "</form>";
                            echo "</td>";
                            echo "<tr>";
                            $count++;
                        }
                        $connect->close();
                        ?>
                </table>
                <div class="list-page" style="margin-left: 85%"> 共<?php echo $count ?>条</div>
            </div>

        </div>
    </div>
</div>
</body>
</html>