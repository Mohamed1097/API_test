<?php
header('content-type:application/json');
require_once '../../config/Database.php';
require_once '../../Models/post.php';
$post=new post(new Database('posts'));
$id=$_GET['id'] ?? "";
echo $post->getPost($id);