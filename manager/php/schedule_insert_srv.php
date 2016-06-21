<?php
require_once "../conf/conf.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="../css/common.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <script type="text/javascript" src="../js/houtai.js"></script>
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
                        <li><a href="../studio_manager.php"><i class="icon-font">&#xe044;</i>影厅管理</a></li>
                        <li><a href="../movie_manager.php"><i class="icon-font">&#xe034;</i>影片管理</a></li>
                        <li><a href="../seat_manager.php"><i class="icon-font">&#xe063;</i>座位管理</a></li>
                        <li><a href="../schedule_manager.php"><i class="icon-font">&#xe014;</i>演出计划管理</a></li>
                        <li><a href="../managerStatistic.php"><i class="icon-font">&#xe065;</i>财务管理</a></li>
                        <li><a href="../movieStatistics.php"><i class="icon-font">&#xe042;</i>票房统计</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="../employee_manager.php"><i class="icon-font">&#xe017;</i>人事管理</a></li>
                        <li><a href="../change_passwd.php"><i class="icon-font">&#xe017;</i>密码重置</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- 菜单栏结束-->

    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.html">首页</a><span
                    class="crumb-step">&gt;</span><span>添加演出计划</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <?php
                /**
                 * Created by PhpStorm.
                 * User: zhoupan
                 * Date: 6/16/16
                 * Time: 12:18 PM
                 */

                /*
                 * 获取信息
                 */
                $studio_id = $_POST['studio_id'];
                $play_id = $_POST['play_id'];
                $time = $_POST['time'];
                $discount = $_POST['discount'];
                $price = $_POST['price'];

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
                if ($price < 0) {
                    echo "<p>价格不合法！</p>";
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
                    $query = "insert into schedule ( studio_id,play_id,time,discount,price,status ) values(" . $studio_id . "," . $play_id . ",\"" . $time . "\"," . $discount . "," . $price . ",".$status.") ;";
                    //echo $query;
                    $result = $connect->query($query);

                    if ($result) {
                        echo "Success";
                    } else {
                        echo "failure";
                    }
                } else {
                    echo "Information Error!";
                }
                ?>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
