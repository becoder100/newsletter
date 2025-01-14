<?php
// get_news.php
header('Content-Type: application/json');
require_once 'config.php';

$category = isset($_GET['category']) ? $_GET['category'] : 'technology';
$news = fetchCategoryNews($category);

echo json_encode($news);
?>