<?php
require __DIR__ . '/modules/matrix_file_write.php';
$path = __DIR__ . '/errors.php';
$errors = [];
error_write_file($errors,$path);
$dir = __DIR__;
header('Location:/views/matrix_size_input.php/?dir='. $dir);