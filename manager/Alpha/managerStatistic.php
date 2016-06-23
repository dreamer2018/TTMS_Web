<?php
    require_once "conf/conf.php";
?>
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


<!-- 网页头部 -->
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
                        <li><a href="schedule_manager.php"><i class="icon-font">&#xe014;</i>演出计划管理</a></li>
                        <li><a href="managerStatistic.php"><i class="icon-font">&#xe065;</i>财务管理</a></li>
                        <li><a href="movieStatistics.php"><i class="icon-font">&#xe042;</i>票房统计</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="employee_manager.php"><i class="icon-font">&#xe017;</i>人事管理</a></li>
                        <li><a href="change_passwd.php"><i class="icon-font">&#xe017;</i>密码重置</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- 菜单栏结束-->

    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list">
                <i class="icon-font"></i>
                <a href="index.php">首页</a>
                <span class="crumb-step">&gt;</span>
                <span class="crumb-name">统计</span>
            </div>
        </div>

        <div class="result-wrap">
            <div class="result-content" id="fid">
                <!--统计粗略开始-->
                <table class="result-tab" width="100%" id="tableid" cellpadding="0" cellspacing="0">
                    <tr>
                        <th class="tc">ID</th>
                        <th class="tc">工号</th>
                        <th class="tc">姓名</th>
                        <th class="tc">电话号码</th>
                        <th class="tc">销售额</th>
                    </tr>

                    <?php

                    /*
                    * 连接数据库
                    */
                    $emp_no = $_SESSION['username'];
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
                     * 选出经理属于那个剧院
                     */
                    $query = "select theater_id from manager where emp_no =\"" . $emp_no . "\";";
                    $result2 = $connect->query($query);
                    $row2 = $result2->fetch_array();
                    if (!is_null($row2['theater_id'])) {
                        /*
                         * 选出此剧院所有售票员
                         */
                        echo $row2['id'];
                        $query = "select id,emp_no,name,tel from employee where theater_id = " . $row2['theater_id'] . ";";
                        $result = $connect->query($query);
                        $c = 0;
                        while ($row = $result->fetch_array()) {

                            $sum = 0;
                            /*
                             * 找出每个售票员的账单
                             */
                            $query = "select price from bill where  emp_id = " . $row['id'] . ";";
                            $result3 = $connect->query($query);
                            while ($row3 = $result3->fetch_array()) {
                                /*
                                 * 将票价类加
                                 */
                                $sum += $row3['price'];
                            }
                            $c++;
                            echo "<tr>";
                            echo "<td class=\"tc\">" . $row['id'] . "</td>";
                            echo "<td class=\"tc\">" . $row['emp_no'] . "</td>";
                            echo "<td class=\"tc\">" . $row['name'] . "</td>";
                            echo "<td class=\"tc\">" . $row['tel'] . "</td>";
                            echo "<td class=\"tc\">" . $sum . "</td>";
                            echo "</tr>";
                        }
                    }
                    $connect->close();
                    ?>

                </table>
                <!--统计粗略-->
                <div class="list-page" style="margin-left: 85%">共<?php echo $c ?>条</div>
                <div class="search-wrap">
                    <div class="search-content">

                        <form action="managerStatistic.php" method="post">
                            <table class="search-tab">
                                <tr>
                                    <th width="120">售票员ID:</th>
                                    <td>
                                        <select name="emp_id">
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


                                            $query = "select theater_id from manager where emp_no =\"" . $emp_no . "\";";
                                            $result2 = $connect->query($query);
                                            $row2 = $result2->fetch_array();

                                            $query = "select id from employee where theater_id =" . $row2['theater_id'] . ";";

                                            $result = $connect->query($query);
                                            while ($row = $result->fetch_array()) {
                                                echo "<option value=" . $row["id"] . ">" . $row["id"] . "</option>";
                                            }
                                            $connect->close();
                                            ?>
                                        </select>
                                    </td>
                                    <th width="120">日期:</th>
                                    <td>
                                        <select name="sale_time">
                                            <option value="0">全部</option>
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

                                            $query = "select distinct sale_time from bill;";
                                            $result = $connect->query($query);
                                            while ($row = $result->fetch_array()) {
                                                echo "<option value=" . $row["sale_time"] . ">" . $row["sale_time"] . "</option>";
                                            }
                                            $connect->close();
                                            ?>
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
                <table class="result-tab" width="100%" id="detailed" cellpadding="0" cellspacing="0">
                    <tr>
                        <th>账单ID</th>
                        <th>票ID</th>
                        <th>电影名称</th>
                        <th>单价</th>
                        <th>日期</th>
                    </tr>

                    <?php
                    if (isset($_POST['emp_id'])) {

                        $emp_id = $_POST['emp_id'];
                        $sale_time = $_POST['sale_time'];


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

                        $select = $connect->select_db($DB_NAME);

                        if ($sale_time == 0) {

                            $query = "select id,ticket_id,play_id,sale_time,price from bill where emp_id =" . $emp_id . ";";

                            $result = $connect->query($query);
                            while ($row = $result->fetch_array()) {
                                $query = "select name from play where id = " . $row['play_id'] . ";";

                                $result2 = $connect->query($query);

                                while ($row2 = $result2->fetch_array()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['ticket_id'] . "</td>";
                                    echo "<td>" . $row2['name'] . "</td>";
                                    echo "<td>" . $row['sale_time'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    echo "</tr>";
                                }
                            }
                        } else {
                            $query = "select id,ticket_id,play_id,sale_time,price from bill where sale_time = \"" . $sale_time . "\" and emp_id = " . $emp_id . ";";
                            $result = $connect->query($query);
                            while ($row = $result->fetch_array()) {

                                $query = "select name from play where id = " . $row['play_id'] . ";";

                                $result2 = $connect->query($query);
                                while ($row2 = $result2->fetch_array()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['ticket_id'] . "</td>";
                                    echo "<td>" . $row2['name'] . "</td>";
                                    echo "<td>" . $row['sale_time'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    echo "</tr>";
                                }
                            }

                        }
                        $connect->close();
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>