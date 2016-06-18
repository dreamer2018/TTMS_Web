<?php
require_once "../conf/conf.php";
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
                <li><a href="#"><i class="icon-font">&#xe014;</i></a></li>
                <li><a href="#"><i class="icon-font">&#xe059;</i></a></li>
            </ul>
        </div>
    </div>
</div>
<!--头部结束-->


<div class="container clearfix">


    <!--网页菜单栏-->
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="book_ticket.php"><i class="icon-font">&#xe044;</i>售票</a></li>
                        <li><a href="return_ticket.php"><i class="icon-font">&#xe034;</i>退票</a></li>
                        <li><a href="select_action.php"><i class="icon-font">&#xe063;</i>影片查询</a></li>
                        <li><a href="schedule_select.php"><i class="icon-font">&#xe014;</i>演出计划查询</a></li>
                        <li><a href="employeeStatistic.php"><i class="icon-font">&#xe065;</i>统计</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="change_passwd.php"><i class="icon-font">&#xe017;</i>更改密码</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--菜单栏结束-->


    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span
                    class="crumb-step">&gt;</span><span class="crumb-name">退票</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="return_ticket.php" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">账单ID:</th>
                            <td>
                                <select name="bill_id">
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

                                    $query = "select id from bill;";
                                    echo $query;
                                    $result = $connect->query($query);
                                    while ($row = $result->fetch_array()) {

                                        echo "<option value=" . $row["id"] . ">" . $row["id"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <th width="120">手机号:</th>
                            <td>
                                <input type="text" name="tel">
                            </td>
                            <th width="50"></th>
                            <td>
                                <input class="btn btn-primary btn2" name="sub" value="查询" type="submit">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-content" id="fid">
                <?php
                if (isset($_POST['bill_id'])) {

                    $bill_id = $_POST['bill_id'];
                    $tel = $_POST['tel'];
                    if (strlen($tel) != 11) {
                        echo "手机号错误";
                    } else {


                        echo " <table class=\"result-tab\" width=\"100%\" id=\"tableid\" cellpadding=\"0\" cellspacing=\"0\">";
                        echo "<tr >";
                        echo "<th > ID</th >";
                        echo "<th > 账单ID</th >";
                        echo "<th > 顾客手机号</th >";
                        echo "<th > 影片</th >";
                        echo "<th > 价格</th >";
                        echo "<th > 售票时间</th >";
                        echo "<th > 操作</th >";
                        echo "</tr >";


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

                        $sign = 0; //验证手机号码
                        $count = 0;

                        $select = $connect->select_db($DB_NAME);
                        if ($bill_id == 0) {
                            $query = "select id,customer_id,ticket_id,play_id,price,sale_time from bill";
                        } else {
                            $query = "select id,customer_id,ticket_id,play_id,price,sale_time from bill where id = " . $bill_id . ";";
                        }
                        $result = $connect->query($query);
                        while ($row = $result->fetch_array()) {

                            $query = "select tel from customer where id = " . $row['customer_id'] . ";";
                            $result2 = $connect->query($query);
                            $row2 = $result2->fetch_array();

                            if ($row2['tel'] == $tel) {
                                $sign = 1;
                                $count++;
                                $query = "select name from play where id =" . $row['play_id'] . ";";
                                $result3 = $connect->query($query);
                                $row3 = $result3->fetch_array();

                                echo "<tr>";
                                echo "<td>" . $count . "</td>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $tel . "</td>";
                                echo "<td>" . $row3['name'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td>" . $row['sale_time'] . "</td>";
                                echo "<td>";
                                echo "<form name=\"myform\" action=\"return_ticket.php\" id=\"myform\" method=\"post\">";
                                echo "<input type=\"hidden\" name = \"re_bill_id\" value=" . $row['id'] . ">";
                                echo "<input type=\"submit\" class=\"btn btn-primary btn2\" value=\"退票\">";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                        echo "</table>";
                        echo "<div class=\"list-page\" style=\"margin-left:85%;\">共" . $count . "条";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>

        <div class="result-wrap">
            <?php
            if (isset($_POST['re_bill_id'])) {
                $re_bill_id = $_POST['re_bill_id'];


                $connect = new mysqli($DB_HOST, $DB_USER, $DB_PASSWD);
                if (!$connect) {
                    die("Connect DataBase Error!<br/>");
                }
                $select = $connect->select_db($DB_NAME);
                $query = "select ticket_id from bill where id = " . $re_bill_id . ";";
                $result = $connect->query($query);
                $row = $result->fetch_array();
                $query = "update ticket set status = 0 where id =" . $row['ticket_id'] . ";";
                $connect->query($query);
                $query = "delete from bill where id =" . $re_bill_id . ";";
                $connect->query($query);
                echo "<h3>退票成功</h3>";
            }
            ?>
        </div>
    </div>
    <!--/main-->
    <script type="text/javascript">
        function post() {
            forPost.action = "DestinationPage.aspx";
            forPost.submit();
        }
    </script>
</div>
</body>
</html>