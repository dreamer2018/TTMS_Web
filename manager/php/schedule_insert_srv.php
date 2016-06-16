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
    <link rel="stylesheet" type="text/css" href="../css/common.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <script type="text/javascript" src="../js/houtai.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="../index.html" class="navbar-brand">后台管理</a></h1>
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
                if (!preg_match('/[1-9]\d{14}/', $str, $matches)) {
                    echo "<p>日期错误！</p>";
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
                    $query = "insert into schedule ( studio_id,play_id,time,discount,price ) values(".$studio_id.",".$play_id.",".$time.",".$discount.",".$price.") ;";
                    $result = $connect->query($query);
                }


                ?>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>