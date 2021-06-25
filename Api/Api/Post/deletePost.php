<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once '../../config/Database.php';
require_once '../../Models/post.php';
$deletePost=new post(new Database('posts'));
if ($_SERVER['REQUEST_METHOD']=="POST")
{
    $data = json_decode(file_get_contents("php://input"),true)??"";
    if ($deletePost->deletePost($data)==true) {
        echo json_encode(['message'=>'The Post Is Deleted']);
    }
    elseif($deletePost->deletePost($data)==false)
    {
        echo json_encode(["message"=>"there is something wrong,try again later"]);
    }
}