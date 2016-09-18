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
require('../../mysqli_connect.php');  //连接数据库
$query = 'SELECT a.*,c.name child_menu_name from article a,child_menu c 
          WHERE a.type = c.id';
$result = @mysqli_query($dbc, $query);

?>

<div class="container">
    <div class="row">
        <h2>文章管理</h2>
        <a href="create.php" class="btn btn-success">创建文章</a>
    </div>
    <div class="row">
        <table class="table table-bordered col-md-10">
            <thead>
            <tr>
                <th class="col-md-5">标题</th>
                <th class="col-md-2">作者</th>
                <th class="col-md-2">栏目</th>
                <th class="col-md-3">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($result as $row){
                echo '<tr><td>'.$row['title'].'</td>';
                echo '<td>'.$row['author'].'</td>';
                echo '<td>'.$row['child_menu_name'].'</td>';
                echo '<td>';
                echo '<a href="view.php?id='.$row['id'].'" class="btn btn-default">查看</a>&nbsp;';
                echo '<a href="update.php?id='.$row['id'].'" class="btn btn-primary">更新</a>&nbsp;';
                echo '<a href="delete.php?id='.$row['id'].'" class="btn btn-danger">删除</a>';
                echo '</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>

</div>
<?php include('../../includes/footer.php'); ?>
</body>
</html>

