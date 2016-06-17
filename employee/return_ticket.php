<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["identity"])) {
    die("<h1>非法访问</h1>");
}
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
                        <li><a href="return.html"><i class="icon-font">&#xe034;</i>退票</a></li>
                        <li><a href="php/select_action.php"><i class="icon-font">&#xe063;</i>影片查询</a></li>
                        <li><a href="schedule_select.php"><i class="icon-font">&#xe014;</i>演出计划查询</a></li>
                        <li><a href="employeeStatistic.php"><i class="icon-font">&#xe065;</i>统计</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="change_passwd.html"><i class="icon-font">&#xe017;</i>更改密码</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--菜单栏结束-->


    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span
                    class="crumb-step">&gt;</span><span class="crumb-name">退票</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">账单ID:</th>
                            <td>
                                <select name="bill_id">
                                    <option value="0">全部</option>
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
            <form name="myform" id="myform" method="post">
                <div class="result-content" id="fid">
                    <table class="result-tab" width="100%" id="tableid" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>ID</th>
                            <th>账单ID</th>
                            <th>顾客手机号</th>
                            <th>影片</th>
                            <th>价格</th>
                            <th>售票时间</th>
                            <th>操作</th>
                        </tr>
                        <tr>
                            <td>59</td>
                            <td title="美国队长3"><a target="_blank" href="#" title="美国队长3">美国队长3</a> …
                            </td>
                            <td>IMAX</td>
                            <td>2号厅</td>
                            <td>正在上映</td>
                            <td>5.11 21:11:01-5.11 23:11:01</td>
                            <td>
                                <input type="submit" class="btn btn-primary btn2" value="退票">
                            </td>
                        </tr>
                        <?php
                        if (isset($_POST['bill_id'])) {

                            $bill_id = $_POST['bill_id'];
                            $tel = $_POST['tel'];
                            if (strlen($tel) != 11) {
                                echo "手机号错误";
                            } else {
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

                                /*
                                 * 选择数据库
                                 */

                                /*
                                    <th>ID</th>
                                    <th>账单ID</th>
                                    <th>顾客手机号</th>
                                    <th>影片</th>
                                    <th>价格</th>
                                    <th>售票时间</th>
                                    <th>操作</th>
                                */
                                $sign = 0; //验证手机号码
                                $count = 0;

                                $select = $connect->select_db($DB_NAME);
                                if ($bill_id == 0) {
                                    $query = "select id,customer_id,ticket_id,play_id,price sale_time from bill";
                                } else {
                                    $query = "select id,customer_id,ticket_id,play_id,price sale_time from bill where id = " . $bill_id . ";";
                                }
                                $result = $connect->query($query);
                                while ($row = $result->fetch_array()) {

                                    $query = "select tel from customer where id = " . $row['customer_id'] . ";";
                                    $result2 = $connect->query($query);
                                    $row2 = $result2->fetch_array();
                                    echo $row2['tel'] . "<br/>";
                                    if ($row2['tel'] == $tel) {
                                        $sign = 1;
                                        $count++;
                                        $query = "select name from play where id =".$row['play_id'].";";
                                        $result3 = $connect->query($query);
                                        $row3 = $result3->fetch_array();
                                        echo "<tr>";
                                        echo "<td>".$count."</td>";
                                        echo "<td>".$row['id']."</td>";
                                        echo "<td>".$tel."</td>";
                                        echo "<td>".$row3['name']."</td>";
                                        echo "<td>".$row['price']."</td>";
                                        echo "<td>".$row['sale_time']."</td>";
                                        echo "";
                                        echo "<td>";
                                        echo "<input type=\"submit\" class=\"btn btn-primary btn2\" value=\"退票\">";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                        ?>
                    </table>
                    <div class="list-page"> 1 条 1/1 页</div>
                </div>
            </form>
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