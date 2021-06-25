<?php
header('content-type:application/json');
require_once '../../config/Database.php';
require_once '../../Models/category.php';
$category=new Category(new Database('categories'));
$id=$_GET['id'] ?? "";
echo $category->getCategory($id);