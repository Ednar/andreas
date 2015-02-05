<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo 'Title:' . $print->title . '<br>';
echo 'URL:' . $print->url . '<br>';
echo 'Size:' . $print->size . '<br>';
echo 'Price:' . $print->price . '<br>';
?>
