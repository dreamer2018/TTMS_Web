<?php
    require_once "../conf/conf.php"
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
                <span>更改密码</span>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <?php
                /*
                 * 获取前台发来的数据
                 */
                $old_passwd = $_POST["old_passwd"];
                $new_passwd = $_POST["new_passwd"];
                $confirm_passwd = $_POST["confirm_passwd"];

                /*
                 * 从SESSION中取出用户信息
                 */
                $emp_no = $_SESSION["username"];
                $identity = $_SESSION["identity"];

                /*
                 * 对输入的安全性进行校验进行校验
                */

                $emp_no = htmlentities($emp_no, ENT_QUOTES, "UTF-8");
                $old_passwd = htmlentities($old_passwd, ENT_QUOTES, "UTF-8");
                $new_passwd = htmlentities($new_passwd, ENT_QUOTES, "UTF-8");
                $confirm_passwd = htmlentities($confirm_passwd, ENT_QUOTES, "UTF-8");

                /*
                 * 对数据进行校验
                 */
                $sign = 1; //信息合法性标志

                //对工号长度做校验
                if (mb_strlen($emp_no) != 8) {
                    echo "<p>工号不正确</p>";
                    if ($sign) {
                        $sign = 0;
                    }
                } else if ($new_passwd != $confirm_passwd) {
                    echo "<p>新密码和确认密码不相同</p><br/>";
                    if ($sign) {
                        $sign = 0;
                    }
                } else {
                    //对密码确认做校验
                    if (mb_strlen($old_passwd) < 1 || mb_strlen($old_passwd) > 20) {
                        echo "<p>原始密码长度过长或过短</p>";
                        if ($sign) {
                            $sign = 0;
                        }
                    }
                    if (mb_strlen($new_passwd) < 1 || mb_strlen($new_passwd) > 20) {
                        echo "<p>新密码长度过长或过短</p>";
                        if ($sign) {
                            $sign = 0;
                        }
                    }
                }
                if ($sign) {

                    /*
                     * 通过身份码识别出身份类型
                     */
                    switch ($identity) {
                        case 1 :
                            $DB_TABLE_NAME = "generalmanager";
                            break; //总经理表
                        case 2 :
                            $DB_TABLE_NAME = "manager";
                            break;      //经理表
                        case 3 :
                            $DB_TABLE_NAME = "employee";
                            break;      //售票员表
                        default :
                            $DB_TABLE_NAME = "";
                    }
                    /*
                     * 如果身份表为空则不进行数据库连接
                     */
                    if ($DB_TABLE_NAME != "") {

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
                         * 写SQL语句
                         */
                        $query = " select passwd from " . $DB_TABLE_NAME . " where emp_no= \"" . $emp_no . "\";";
                        /*
                         * 获取查询结果
                         */
                        $result = $connect->query($query);
                        /*
                         * 对查询结果进行验证
                         */

                        if (!$result) {
                            die("<p>查询失败</p><br/>");
                        } else {
                            while ($row = $result->fetch_array()) {
                                //判断原始密码正确性
                                if ($row["passwd"] == $old_passwd) {
                                    $query = "update " . $DB_TABLE_NAME . " set passwd = \"" . $new_passwd . "\" where emp_no = \"" . $emp_no . "\";";
                                    $result = $connect->query($query);
                                    if ($result) {
                                        echo "<p>密码修改成功！</p><br/>";
                                        break;
                                    } else {
                                        echo "<p>数据库查找失败！</p><br/>";
                                        break;
                                    }
                                } else {
                                    echo "<p>原始密码不正确</p><br/>";
                                    break;
                                }
                            }
                        }
                    } else {
                        echo "<p>身份识别错误！</p><br/>";
                    }
                } else {
                    echo "<p>信息输入错误！</p><br/>";
                }
                ?>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
