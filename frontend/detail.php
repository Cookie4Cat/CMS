<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>内容管理系统</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
</head>
<body>
<?php include ('../includes/header.php'); ?>
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT author,time,content,title FROM article WHERE id = " .$id;
    $result = @mysqli_query($dbc, $query);
    foreach($result as $row){
        $title = $row['title'];
        $author = $row['author'];
        $content = $row['content'];
        $time = $row['time'];
    }
}
?>
<style>
    .article-pan{
        background: #eeeeee;
    }
    .title{
        text-align: center;
    }
    .content{
        text-indent: 2em;
    }
    .author,.time{
        display: inline-block;
        float: right;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 article-pan">
            <div class="title"><h2><?php echo $title?></h2></div>
            <div class="content"><?php echo $content?></div>
            <div class="author"><strong>作者: </strong><?php echo $author?></div>
            <div class="time"><strong>时间: </strong><?php echo $time?></div>
        </div>
    </div>
</div>
<?php include ('../includes/footer.php'); ?>
</body>
</html>
