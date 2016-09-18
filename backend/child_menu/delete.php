<?php
if(isset($_GET['id'])){

    $id = $_GET['id'];
    require('../../mysqli_connect.php');  //连接数据库
    $query = "DELETE FROM child_menu WHERE id = " .$id;
    $r = @mysqli_query($dbc, $query);

    function redirect($url){           //重定向函数
        echo "<script language=\"javascript\">";
        echo "location.href=\"$url\"";
        echo "</script>";
    }
    redirect("index.php");
}
