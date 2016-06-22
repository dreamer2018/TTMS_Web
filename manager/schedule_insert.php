<?php
    require_once "conf/conf.php";
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
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span
                    class="crumb-step">&gt;</span><a class="crumb-name" href="schedule_manager.php">演出计划管理</a><span
                    class="crumb-step">&gt;</span><span>添加演出计划</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="schedule_insert.php" method="post" id="myform" name="myform"
                      enctype="multipart/form-data">
                    <table class="insert-tab" width="100%" id="fid" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <th width="120"><i class="require-red">*</i>演厅：</th>
                            <td>
                                <select name="studio_id" id="studio_id" class="required">
                                    <?php
                                    require_once "../conf/DB_login.php";
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
                                    echo "test";
                                    /*
                                     * 选择数据库
                                     */

                                    $select = $connect->select_db($DB_NAME);

                                    $emp_no = $_SESSION["username"];

                                    $query = "select theater_id from manager where emp_no = \"" . $emp_no . "\";";
                                    echo $query;
                                    $result = $connect->query($query);

                                    $row = $result->fetch_array();
                                    $theater_id = $row[0]['theater_id'];

                                    $query = "select id,name from studio  where theater_id =" . $theater_id . ";";
                                    $result = $connect->query($query);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value=" . $row["id"] . ">" . $row["name"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th width="120"><i class="require-red">*</i>剧目：</th>
                            <td>
                                <select name="play_id" id="play_id" class="required">
                                    <?php
                                    require_once "../DB_login.php";
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
                                    $query = "select id,name from play ;";
                                    $result = $connect->query($query);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value=" . $row["id"] . ">" . $row["name"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>放映时间：</th>
                            <td>
                                <input class="common-text required-red" name="time" size="20" value="" type="text">
                            </td>
                        </tr>
                        <tr>
                            <th>折扣：</th>
                            <td>
                                <input class="common-text required-red" name="discount" size="20" value="" type="text">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <br/>
                    <input id="subid" class="btn btn-primary btn6 mr10" value="提交" type="submit"
                           style="margin-left:4%;">
                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button" style="margin-left:2%;">
                </form>
            </div>
        </div>
    </div>
    <div class="main-wrap">
        <div class="result-wrap">
            <div class="result-content" id="fid">
                <?php
                if (isset($_POST['studio_id'])) {


                    $studio_id = $_POST['studio_id'];
                    $play_id = $_POST['play_id'];
                    $time = $_POST['time'];
                    $discount = $_POST['discount'];

                    $sign = 1; //信息正确性标志

                    /*
                     * 对信息作判断
                     */

                    //时间为14位数字
                    if (strlen($time) != 14) {
                        echo "<p>日期错误！</p><br/>";
                        $sign = 0;
                    }
                    if ($discount > 1 || $discount <= 0) {
                        echo "<p>折扣不合法！</p>";
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
                        $status = 1;
                        $select = $connect->select_db($DB_NAME);
                        $query = "select price from  play where id =" . $play_id . ";";
                        $result2 = $connect->query($query);
                        $row2 = $result2->fetch_array();
                        $price = $row2['price'] * $discount;

                        $query = "insert into schedule ( studio_id,play_id,time,discount,price,status ) values(" . $studio_id . "," . $play_id . ",\"" . $time . "\"," . $discount . "," . $price . "," . $status . ") ;";
                        $result = $connect->query($query);
                        if ($result) {

                            $query = "select row,col from studio where id =" . $studio_id . ";";
                            $result3 = $connect->query($query);
                            $row3 = $result3->fetch_array();

                            $query = "select id from schedule where studio_id = " . $studio_id . " and play_id =" . $play_id . " and time =\"" . $time . "\";";
                            $result4 = $connect->query($query);
                            $schedule_id="";
                            while ($row4 = $result4->fetch_array()){
                                $schedule_id = $row4['id'];
                            }
                            for($i=1;$i<=$row3['row'];$i++ ){
                                for($j=1;$j<=$row3['col'];$j++){
                                    $query = "select id,count(id) from seat where studio_id = ".$studio_id." and row= ".$i." and col = ".$j." and status = 1 ;";
                                    $result5 = $connect->query($query);
                                    $row5 = $result5->fetch_array();
                                    $status =0; //0：待售 1：锁定 2：卖出
                                    if($row5['count(id)'] > 0){
                                        $query = "insert into ticket(seat_id,schedule_id,play_id,price,status) values(".$row5['id'].",".$schedule_id.",".$play_id.",".$price.",".$status.");";
                                        $connect->query($query);
                                    }
                                }
                            }

                            echo "<table class=\"result-tab\" width=\"100%\" id=\"tableid\" cellpadding=\"0\" cellspacing=\"0\">";
                            echo "<tr>";
                            echo "<th>演出厅ID</th>";
                            echo "<th>剧目ID</th>";
                            echo "<th>放映时间</th>";
                            echo "<th>折扣</th>";
                            echo "<th>票价</th>";
                            echo "<th>状态</th>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>" . $studio_id . "</td>";
                            echo "<td>" . $play_id . "</td>";
                            echo "<td>" . $time . "</td>";
                            echo "<td>" . $discount . "</td>";
                            echo "<td>" . $price . "</td>";
                            echo "<td>" . $status . "</td>";
                            echo "</tr>";
                            echo "</table>";
                        }
                    } else {
                        echo "<p>输入的信息有误！</p><br/>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>