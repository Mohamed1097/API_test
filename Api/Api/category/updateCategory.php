<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once '../../config/Database.php';
require_once '../../Models/category.php';
$updateCategory=new Category(new Database('categories'));
if ($_SERVER['REQUEST_METHOD']=="POST")
{
    $data = json_decode(file_get_contents("php://input"),true)??"";
    if($data!="")
    {
        $cond=end($data) ?? "";
        array_pop($data);
        $updateCategory->updateCategory($data,$cond); 
        
    } 
    else
    {
        echo json_encode(['message'=>'There something Wrong, Try Again Later 1']);   
    }
}