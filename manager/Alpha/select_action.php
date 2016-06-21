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
                <span class="crumb-name">影片查询</span>
            </div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="select_action.php" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">类型:</th>
                            <td>
                                <select name="type">
                                    <option value="%">全部</option>
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
                                    $query = "select id,type from type;";
                                    $result = $connect->query($query);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value=" . $row["id"] . ">" . $row["type"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <th width="120">语言:</th>
                            <td>
                                <select name="lang">
                                    <option value="%">全部</option>
                                    <?php
                                    $DB_TABLE_NAME = "lang";
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
                                    $query = "select id,type from lang ;";
                                    $result = $connect->query($query);

                                    while ($row = $result->fetch_array()) {
                                        echo "<option value=" . $row["id"] . ">" . $row["type"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <th width="120">等级:</th>
                            <td>
                                <select name="level">
                                    <option value="%">全部</option>
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
                                    $query = "select id,type from level ;";
                                    $result = $connect->query($query);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value=" . $row["id"] . ">" . $row["type"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <th width="120">时长:</th>
                            <td>
                                <select name="length">
                                    <option value="0">全部</option>
                                    <option value="90">90<</option>
                                    <option value="90120">90-120</option>
                                    <option value="120">>120</option>
                                </select>
                            </td>
                            <th width="120">票价:</th>
                            <td>
                                <select name="price">
                                    <option value="0">全部</option>
                                    <option value="20">20<</option>
                                    <option value="2060">20-60</option>
                                    <option value="60">>60</option>
                                </select>
                            </td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="keywords" value="" id="" type="text">
                            </td>
                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
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
                            <th>影片名称</th>
                            <th>影片类型</th>
                            <th>语言</th>
                            <th>等级</th>
                            <th>评分</th>
                            <th>票价</th>
                            <th>时长</th>
                        </tr>
                        <?php
                        $count = 0;
                        if (isset($_POST['type'])) {
                            $type = $_POST["type"];
                            $lang = $_POST["lang"];
                            $level = $_POST["level"];
                            $last = $_POST["length"];
                            $price = $_POST["price"];
                            $keywords = $_POST["keywords"];
                            /*
                                echo $type;
                                echo $lang;
                                echo $level;
                                echo $last;
                                echo $price;
                                echo $keywords;
                            */
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


                            /*
                             * 写SQL语句
                             */
                            /*
                            if($type==0 && $lang ==0 && $level == 0 && $last == 0 && $price ){
                                $query="select id,name,type_id,lang_id,level_id,score,length,price from play";
                            }elseif ($type !=0 && $lang ==0 && $level == 0 && $last == 0 && $price ){
                                $query="select id,name,type_id,lang_id,level_id,score,length,price from play where type =".$type.";";
                            }elseif ($type !=0 && $lang !=0 && $level == 0 && $last == 0 && $price ){

                            }*/
                            if ($last == 0 && $price == 0) {
                                $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\";";
                            } elseif ($last != 0 && $price == 0) {
                                switch ($last) {
                                    case '90':
                                        $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\" and length < 90 ;";
                                        break;
                                    case '90120':
                                        $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\" and length >= 90 and length <= 120 ;";
                                        break;
                                    case '120':
                                        $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\"  and length > 120;";
                                        break;
                                }
                            } elseif ($last == 0 && $price != 0) {
                                switch ($price) {
                                    case "20":
                                        $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\"  and  price < 20 ;";
                                        break;
                                    case "2060":
                                        $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\"  and  price >= 20 and price <=60 ;";
                                        break;
                                    case "60":
                                        $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\"  and  price > 60 ;";
                                        break;
                                }
                            } else {
                                if ($last == 90) {
                                    switch ($price) {
                                        case "20":
                                            $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\" and length < 90  and  price < 20 ;";
                                            break;
                                        case "2060":
                                            $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\"  and length < 90 and  price >= 20 and price <=60 ;";
                                            break;
                                        case "60":
                                            $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\"  and length < 90 and  price > 60 ;";
                                            break;
                                    }
                                } elseif ($last == 90120) {
                                    switch ($price) {
                                        case "20":
                                            $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\" and length >= 90 and length <= 120  and  price < 20 ;";
                                            break;
                                        case "2060":
                                            $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\"  and length >= 90 and length <= 120 and  price >= 20 and price <=60 ;";
                                            break;
                                        case "60":
                                            $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\"  and length >= 90 length <=120  and  price > 60 ;";
                                            break;
                                    }
                                } else {
                                    switch ($price) {
                                        case "20":
                                            $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\" and length > 120  and  price < 20 ;";
                                            break;
                                        case "2060":
                                            $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\"  and length > 120 and  price >= 20 and price <=60 ;";
                                            break;
                                        case "60":
                                            $query = "select id,name,type_id,lang_id,level_id,score,length,price from play where type_id like \"" . $type . "\" and  lang_id like \"" . $lang . "\" and level_id like \"" . $level . "\"  and length >120  and  price > 60 ;";
                                            break;
                                    }
                                }
                            }
                            /*
                             * 获取查询结果
                             */

                            $result = $connect->query($query);

                            if (!$result) {
                                die("<p>查询失败</p><br/>");
                            } else {
                                while ($row = $result->fetch_array()) {

                                    $type = "";
                                    $lang = "";
                                    $level = "";
                                    $score = "";
                                    $length = "";

                                    $query = "select type from type where id = " . $row['type_id'] . ";";

                                    $result2 = $connect->query($query);
                                    $row2 = $result2->fetch_array();
                                    $type = $row2[0];

                                    /*
                                    while ($row2 = $result2->fetch_array()) {
                                        # code...
                                        $type = $row2["type"];
                                    }*/

                                    $query = "select type from lang where id = " . $row['lang_id'] . ";";
                                    $result3 = $connect->query($query);
                                    $row3 = $result3->fetch_array();
                                    $lang = $row3[0];

                                    /*
                                    while ($row3 = $result3->fetch_array()) {
                                        # code...
                                        $lang = $row3["type"];
                                    }
                                    */

                                    $query = "select type from level where id = " . $row['level_id'] . ";";
                                    $result4 = $connect->query($query);
                                    $row4 = $result4->fetch_array();
                                    $level = $row4[0];
                                    /*
                                    while ($row4 = $result4->fetch_array()) {
                                        # code...
                                        $level = $row4["type"];
                                    }
                                    */
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td >" . $row["name"] . "</td>";
                                    echo "<td>" . $type . "</td>";
                                    echo "<td>" . $lang . "</td>";
                                    echo "<td>" . $level . "</td>";
                                    echo "<td>" . $row['score'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    echo "<td>" . $row['length'] . "</td>";
                                    echo "</tr>";
                                    $count++;
                                }
                            }
                        }
                        ?>
                    </table>
                    <div class="list-page" style="margin-left:85%">共<?php echo $count ?>条</div>
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
