<?php
define("DB_USER", "root");
define("DB_PASSWORD", "YDk83946759");
define("DB_HOST", "115.28.33.158");
define("DB_NAME", "my_cms");

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('连接
                        MYSQL失败'.mysqli_error());
@mysqli_query($dbc,"set character set 'utf8'");
@mysqli_query($dbc,"set names 'utf8'");

