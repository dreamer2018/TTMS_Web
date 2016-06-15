<?php
/**
 * Created by PhpStorm.
 * User: zhoupan
 * Date: 6/15/16
 * Time: 6:38 PM
 */

  if(isset($_POST['id']))
  {
      echo "有ID";
      echo $_POST['id'];
      echo $_POST['search'];
  }
  else
  {
      echo "没ID";
  }
  ?>
<form  action="post_myself.php" method="POST">
    <input type=text name="id"/>
    <select name="search" >
        <option value="18">全部</option>
        <option value="19">英语</option>
        <option value="20">国语</option>
    </select>
    <input type=submit value="go"/>
</form>