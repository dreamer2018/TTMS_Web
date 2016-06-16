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
                        <li><a href="booking.html"><i class="icon-font">&#xe044;</i>售票</a></li>
                        <li><a href="return.html"><i class="icon-font">&#xe034;</i>退票</a></li>
                        <li><a href="php/select_action.php"><i class="icon-font">&#xe063;</i>影片查询</a></li>
                        <li><a href="schedule_select.php"><i class="icon-font">&#xe014;</i>演出计划查询</a></li>
                        <li><a href="employeeStatistic.html"><i class="icon-font">&#xe065;</i>统计</a></li>
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
            <div class="crumb-list">
                <i class="icon-font"></i>
                <a href="index.html">首页</a>
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
                        <th>电影名称</th>
                        <th>票数</th>
                        <th>单价</th>
                        <th>总价</th>
                    </tr>
                    <tr>
                        <td title="美国队长3"><a target="_blank" href="#" title="美国队长3">美国队长3</a> …
                        </td>
                        <td>美国队长3</td>
                        <td>150</td>
                        <td>40</td>
                        <td>6000</td>
                    </tr>
                    <tr>
                        <?php
                        require_once "../conf/DB_login.php";
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
                        $query = "select distinct play_id from bill;";
                        $result = $connect->query($query);
                        $c=0;
                        while ($row = $result->fetch_array()) {

                            $query = "select price,count(id) from bill where id = ".$row['play_id'].";";
                            $result = $connect->query($query);
                            $row = $result->fetch_array() ;
                            $count = $row[0]['count(id)'];
                            $price = $row[0]['price'];
                            $sum=$count*$price;

                            $query = "select name from play where id = ".$row['play_id'].";";
                            $result = $connect->query($query);
                            $row = $result->fetch_array() ;
                            $movie_name = $row[0]['name'];

                            $c++;
                            echo "<td>".$c."</td>";
                            echo "<td>".$movie_name."</td>";
                            echo "<td>".$count."</td>";
                            echo "<td>".$price."</td>";
                            echo "<td>".$sum."</td>";

                        }
                        ?>
                    </tr>
                </table>
                <!--统计粗略-->
                <div class="list-page"> 1 条 1/1 页</div>
                <div class="search-wrap">
                    <div class="search-content">
                        <form action="#" method="post">
                            <table class="search-tab">
                                <tr>
                                    <th width="120">影片名称:</th>
                                    <td>
                                        <select name="play_id">
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

                                            $query = "select id,name from play;";

                                            $result = $connect->query($query);
                                            while ($row = $result->fetch_array()) {
                                                echo "<option value=" . $row["id"] . ">" . $row["name"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <th width="120">日期:</th>
                                    <td>
                                        <select name="sale_name">
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

                                            $query = "select distinct sale_time from bill;";

                                            $result = $connect->query($query);
                                            while ($row = $result->fetch_array()) {
                                                echo "<option value=" . $row["sale_time"] . ">" . $row["sale_time"] . "<option>";
                                            }
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
                    <tr>
                        <td>美国队长3</td>
                        <td>545656.545</td>
                        <td>美国队长3</td>
                        <td>5.11 21:11:01-5.11 23:11:01</td>
                        <td>150</td>
                    </tr>
                    <tr>
                    <?php
                    if(isset($_POST['play_id'])){

                        $play_id = $_POST['movie_name'];
                        $sale_time = $_POST['sale_time'];

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
                        $select = $connect->select_db($DB_NAME);
                        

                        if($play_id == 0 && $sale_time == 0){
                            $query = "select id,ticket_id,play_id,sale_time,price from bill;";    
                        }elseif ($movie_name != 0 && $sale_time == 0) {
                            $query = "select id,ticket_id,play_id,sale_time,price from bill where play_id = ".$play_id.";";
                        }elseif($movie_name ==0 && $sale_time != 0 ){
                            $query ="select id,ticket_id,play_id,sale_time,price from bill where play_id = \"".$sale_time."\";"; 
                        }else{
                            $query = "select id,ticket_id,play_id,sale_time,price from bill where play_id = ".$play_id." and sale_time = \"".$sale_time."\";";
                        }

                        $result = $connect->query($query);
                            while ($row = $result->fetch_array()) {

                                $query = "select name from play where id = ".$play_id.";";
                                $result = $connect->query($query);
                                $row2 = $result2->fetch_array();                                
                                $play_name = $row2['name'];
                                echo "<td>".$row['id']."</td>"
                                echo "<td>".$row['ticket_id']."</td>"
                                echo "<td>".$play_name."</td>"
                                echo "<td>".$row['sale_time']."</td>"
                                echo "<td>".$row['price']."</td>"
                        }
                    }
                    ?>
                    </tr>
                </table>
            </div>
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