<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once '../../config/Database.php';
require_once '../../Models/post.php';
$updatePost=new post(new Database('posts'));
if ($_SERVER['REQUEST_METHOD']=="POST")
{
    $data = json_decode(file_get_contents("php://input"),true)??"";
    if($data!="")
    {
        $cond=end($data) ?? "";
        array_pop($data);
        if (gettype($data['category_id'])!="integer") 
        {
            echo json_encode(['message'=>'There something Wrong, Try Again Later 12']); 
        }
        else
        {
            $updatePost->updatePost($data,$cond); 
        }
    } 
    else
    {
        echo json_encode(['message'=>'There something Wrong, Try Again Later 33']);   
    }
}