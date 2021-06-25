<?php
header('content-type:application/json');
require_once '../../config/Database.php';
require_once '../../Models/category.php';
$categories=new Category(new Database('categories'));
echo $categories->getAll();