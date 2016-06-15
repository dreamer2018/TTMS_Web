<?php
/**
 * Created by PhpStorm.
 * User: zhoupan
 * Date: 6/14/16
 * Time: 8:09 PM
 */
/*
 *  通过POST请就接收到前端发来的用户名和密码
 */

$username = $_POST["username"];
$password = $_POST["password"];

/*
 * 对输入的内容进行校验
 */
$username = htmlentities($username, ENT_QUOTES, "UTF-8");
$password = htmlentities($password, ENT_QUOTES, "UTF-8");

//$password = md5($password.'linux');

$message="";  //输出提示信息
$url="";      //跳转url
$sign=0;      //用户名密码验证成功标志


/*
 * 对数据进行解析，得出身份类型
 */
if ($username[0] == '1') {
    $identity = 1;
    $url="generalmanager/index.html";
} elseif ($username[0] == '2') {
    $identity = 2;
    $url="manager/index.html";
} elseif ($username[0] == '3') {
    $identity = 3;
    $url="employee/index.html";
} else {
    $identity = 0;
}
/*
 * 身份验证
 */
if ($identity) {

    /*
     * 通过身份数，得到对应的数据表
     */
    switch ($identity){
        case 1 : $DB_TABLE_NAME="generalmanager"; break; //总经理表
        case 2 : $DB_TABLE_NAME="manager";  break;      //经理表
        case 3 : $DB_TABLE_NAME="employee"; break;      //售票员表
        default : $DB_TABLE_NAME="";
    }

    /*
     * 如果身份表为空则不进行数据库连接
     */
    if($DB_TABLE_NAME !=""){

        require_once "DB_login.php";
        /*
         * 连接数据库
         */
        $connect = new mysqli($DB_HOST,$DB_USER,$DB_PASSWD);
        /*
         * 如果连接失败，则直接结束
         */
        if(!$connect){
            die("Connect DataBase Error!<br/>");
        }

        /*
         * 选择数据库
         */
        $select=$connect->select_db($DB_NAME);

        /*
         * 写SQL语句
         */
        $query=" select passwd from ".$DB_TABLE_NAME." where emp_no= \"".$username."\";";
        /*
         * 获取查询结果
         */
        $result=$connect->query($query);
        /*
         * 对查询结果进行验证
         */

        if(!$result){
            die("查询失败<br/>");
        }else{

            while ($row = $result->fetch_array()){

                if($row["passwd"] == $password){
                    $message = "登陆成功,正在跳转......";
                    $sign=1;
                }else{
                    $message = "用户名或密码不正确";
                }
                //校验成功

                /*
               $_SESSION['user'] = $username;
               $_SESSION['identity'] = $identity;


               if(isset($_SESSION['user'])){
                   echo $_SESSION['user'];
               }
               */
            }
        }
    }else{
        $message = "用户名或密码错误,请重新登录！";
    }
}else{
    $message = "用户名或密码错误,请重新登录！";
}

if(!$sign){
    $url="login.html";
}
?>
<html>
<head>
<meta http-equiv="refresh" content="1;
url=<?php echo $url; ?>">
</head>
<body>
<?php echo $message; ?>
</body>
</html>