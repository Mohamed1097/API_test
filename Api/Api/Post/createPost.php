<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once '../../config/Database.php';
require_once '../../Models/post.php';
$createPost=new post(new Database('posts'));
if ($_SERVER['REQUEST_METHOD']=="POST")
 {
    $data = json_decode(file_get_contents("php://input"),true)??"";  
    if ($data!="")
     {
         if (gettype($data['category_id'])!="integer")
         {
            echo json_encode(['Message'=>'There Is someThing Wrong Try Again Later 1']); 
         }
         else
         {
            $createPost->createPost($data);
         }
       
    }
    else
    {
        echo json_encode(['Message'=>'enter Your Post']);
    }
}