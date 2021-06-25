<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once '../../config/Database.php';
require_once '../../Models/category.php';
$deleteCategory=new Category(new Database('categories'));
if ($_SERVER['REQUEST_METHOD']=="POST")
{
    $data = json_decode(file_get_contents("php://input"),true)??"";
    if ($deleteCategory->deleteCategory($data)==true) {
        echo json_encode(['message'=>'The Category Is Deleted']);
    }
    elseif($deleteCategory->deleteCategory($data)==false)
    {
        echo json_encode(["message"=>"there is something wrong,try again later"]);
    }
}