<?php
header('content-type:application/json');
require_once '../../config/Database.php';
require_once '../../Models/post.php';
$posts=new post(new Database('posts'));
echo $posts->getAll();
