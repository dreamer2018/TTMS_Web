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
                    class="crumb-step">&gt;</span><a class="crumb-name" href="seat_manager.php">座位管理</a><span
                    class="crumb-step">&gt;</span><span>添加座位</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="add_seat.php" method="post" id="myform" name="myform">
                    <table class="insert-tab" width="100%" id="fid" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <th width="120"><i class="require-red">*</i>影厅ID：</th>
                            <td>
                                <select name="studio_id" id="studio_id" class="required">
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

                                    $query1 = "select theater_id from manager where emp_no =\"" . $_SESSION['username'] . "\";";
                                    $result = $connect->query($query1);
                                    $row = $result->fetch_array();

                                    $query2 = "select id from studio where theater_id = " . $row['theater_id'] . ";";

                                    $result2 = $connect->query($query2);
                                    while ($row2 = $result2->fetch_array()) {
                                        echo "<option value=" . $row2["id"] . ">" . $row2["id"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>行：</th>
                            <td>
                                <input class="common-text required" id="title" name="row" size="10" value=""
                                       type="text">
                            </td>
                        </tr>

                        <tr>
                            <th><i class="require-red">*</i>列：</th>
                            <td>
                                <input class="common-text required-red" name="col" size="10"
                                       value="" type="text">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <br/>
                    <input id="subid" class="btn btn-primary btn6 mr10" value="提交" type="submit"
                           style="margin-left:6%;">
                    <input class="btn btn6" value="返回" type="button" style="margin-left:3%">
                    <br/>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-content" id="fid">
                <?php
                if (isset($_POST['studio_id'])) {

                    $studio_id = $_POST['studio_id'];
                    $rows = $_POST['row'];
                    $cols = $_POST['col'];


                    $sign = 1;  //信息正确性标志

                    /*
                     * 对输入信息进行验证
                     */
                    if ($rows <= 0) {
                        echo "<p>行输入错误！</p><br/>";
                        $sign = 0;
                    }
                    if ($cols <= 0) {
                        echo "<p>列输入错误！</p><br/>";
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

                        /*
                         * 找出演出厅行列值
                         */
                        $query = "select row,col from studio where id = " . $studio_id. ";";
                        $result = $connect->query($query);
                        $row = $result->fetch_array();
                        /*
                         * 判断输入是否合法
                         */
                        if ($rows > $row['row'] or $cols > $row['col']) {
                            echo "<p>您输入的座位不可能存在！</p><br/>";
                        } else {

                            /*
                             * 检查座位是否已经存在
                             */
                            $query = "select count(id) from seat where studio_id =" . $studio_id . " and row = " . $rows . " and col =" . $cols . ";";
                            $result2 = $connect->query($query);
                            $row2 = $result2->fetch_array();


                            if ($row2['count(id)'] > 0) {
                                echo "<p>此座位已存在！</p><br/>";
                            } else {
                                $status = 1;
                                $query = "insert into seat (studio_id,row,col,status) values (" . $studio_id . "," . $rows . "," . $cols . "," . $status . ");";
                                $result3 = $connect->query($query);
                                if ($result3) {
                                    echo "<table class=\"result-tab\" width=\"100%\" id=\"tableid\" cellpadding=\"0\" cellspacing=\"0\">";
                                    echo "<tr>";
                                    echo "<th>演出厅ID</th>";
                                    echo "<th>行</th>";
                                    echo "<th>列</th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>" . $studio_id . "</td>";
                                    echo "<td>" . $rows . "</td>";
                                    echo "<td>" . $cols . "</td>";
                                    echo "</tr>";
                                    echo "</table>";
                                }
                            }
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