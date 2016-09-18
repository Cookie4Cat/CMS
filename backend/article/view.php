<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>内容管理系统</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.js"></script>
</head>
<body>
<?php include('../../includes/backend_header.php'); ?>
<?php

//如果有请求提交
if(isset($_GET['id'])){
    $id = $_GET['id'];
    require('../../mysqli_connect.php');  //连接数据库
    $query = 'SELECT a.*,c.name child_menu_name from article a,child_menu c 
          WHERE a.type = c.id AND a.id = '.$id;
    $r = @mysqli_query($dbc, $query);
    foreach ($r as $row){
        $title = $row['title'];
        $author = $row['author'];
        $content = $row['content'];
        $time = $row['time'];
        $child_menu_name = $row['child_menu_name'];
    }
}
?>

<div class="container">
    <div class="row">
        <h2>查看栏目</h2>
        <ol class="breadcrumb">
            <li><a href="index.php">文章管理</a></li>
            <li><a href="#">查看文章</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-3">属性</th>
                    <th class="col-md-5">内容</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><strong>标题</strong></td>
                    <td><?php echo $title?></td>
                </tr>
                <tr>
                    <td><strong>作者</strong></td>
                    <td><?php echo $author?></td>
                </tr>
                <tr>
                    <td><strong>内容</strong></td>
                    <td><?php echo $content?></td>
                </tr>
                <tr>
                    <td><strong>所属栏目</strong></td>
                    <td><?php echo $child_menu_name?></td>
                </tr>
                <tr>
                    <td><strong>时间</strong></td>
                    <td><?php echo $time?></td>
                </tr>
                </tbody>
            </table>
            <a href="index.php" class="btn btn-success">确定</a>
        </div>
    </div>
</div>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
