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
                    class="crumb-step">&gt;</span><a class="crumb-name" href="employee_manager.php">人事管理</a><span
                    class="crumb-step">&gt;</span><span>添加剧院经理</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="add_employee.php" method="post" id="myform" name="myform">
                    <table class="insert-tab" width="100%" id="fid" cellpadding="0" cellspacing="0">
                        <tbody>
                        <th width="120">影院ID:</th>
                        <td>
                            <select name="theater_id">
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

                                $query = "select id from theater;";

                                $result = $connect->query($query);
                                while ($row = $result->fetch_array()) {
                                    echo "<option value=" . $row["id"] . ">" . $row["id"] . "</option>";
                                }
                                $connect->close();
                                ?>
                            </select>
                        </td>
                        <tr>
                            <th><i class="require-red">*</i>工号：</th>
                            <td>
                                <input class="common-text required" id="title" name="emp_no" size="20"  type="text">
                            </td>
                        </tr>
                        <tr>
                            <th>姓名：</th>
                            <td>
                                <input class="common-text required" id="title" name="name" size="20" type="text">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>登陆密码：</th>
                            <td>
                                <input class="common-text required" id="time" name="passwd" size="20" type="text">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <br/>
                    <tr>
                        <th></th>
                        <td>
                            <input id="subid" class="btn btn-primary btn6 mr10" value="提交" type="submit"
                                   style="margin-left: 5%">
                            <input class="btn btn6" onclick="self.location='employee_manager.php'" value="返回" type="button">
                        </td>
                    </tr>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-content" id="fid">
                <?php
                if (isset($_POST['theater_id'])) {

                    $theater_id = $_POST['theater_id'];
                    $emp_no = $_POST['emp_no'];
                    $name = $_POST['name'];
                    $passwd = $_POST['passwd'];
                    $sign = 1;  //信息正确性标志

                    /*
                     * 对输入信息进行验证
                     */
                    if (strlen($emp_no) != 8 or substr($emp_no, 0, 1) != 2) {
                        echo "<p>工号输入不正确！</p><br/>";
                        $sign = 0;
                    }
                    if (strlen($name) > 40) {
                        echo "<p>姓名过长！</p><br/>";
                        $sign = 0;
                    }
                    if (strlen($passwd) <= 0 or strlen($passwd) > 20) {
                        echo "<p>密码为空或过长！</p><br/>";
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

                        $query = "select count(id) from manager where emp_no =\"" . $emp_no . "\";";
                        $result = $connect->query($query);
                        $row = $result->fetch_array();

                        if ($row['count(id)'] == 0) {

                            $query = "insert into manager (emp_no,theater_id,name,passwd) VALUES (\"" . $emp_no . "\"," . $theater_id . ",\"" . $name . "\",\"" . $passwd . "\");";
                            $result2 = $connect->query($query);
                            if ($result2) {
                                echo "<table class=\"result-tab\" width=\"100%\" id=\"tableid\" cellpadding=\"0\" cellspacing=\"0\">";
                                echo "<tr>";
                                echo "<th>影院ID</th>";
                                echo "<th>工号</th>";
                                echo "<th>姓名</th>";
                                echo "<th>密码</th>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>" . $theater_id . "</td>";
                                echo "<td>" . $emp_no . "</td>";
                                echo "<td>" . $name . "</td>";
                                echo "<td>" . $passwd . "</td>";
                                echo "</tr>";
                                echo "</table>";
                            }
                        }else{
                            echo "<p>工号已存在！</p><br/>";
                        }
                        $connect->close();
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>