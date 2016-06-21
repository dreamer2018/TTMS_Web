<tr>
                                <th><i class="require-red">*</i>放映厅：</th>
                                <td>
                                    <select name="colId" id="homeid" class="required">
                                        <?php
                                           
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

                                            $emp_no=$_SESSION["username"];
                                            $query="select theater_id from manager where emp_no = \"".$emp_no."\";";
                                            $result = $connect ->query($query);
                                            while ($row = $result->fetch_array()) {
                                                $theater_id=$row["theater_id"];
                                            }

                                
                                            $query="select (id,name) from studio where theater_id =".$theater_id.";";
                                            $result = $connect ->query($query);
                                            while ($row = $result->fetch_array()) {
                                                echo "<option value=".$row["id"].">".$row["name"]."</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
