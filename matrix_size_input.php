<?php
if (isset($_POST['size'])) {
    $size = $_POST['size'];
    if ( !is_numeric ($size) ) {

        write_to_errors_file('Error: Entered matrix size is not numerical.');

        header('Location:/views/matrix_size_input.php/?dir=' . __DIR__);

    } else {
        if ($size >= 1) {

            require __DIR__ . '/views/matrix_input.php';
            matrix_input($size);

        } else {

            write_to_errors_file('Error: Entered matrix size is less then 1.');

            header('Location:/views/matrix_size_input.php/?dir=' . __DIR__);
        }
    }
} else {

    write_to_errors_file('Error: Matrix size is not specified.');

    header('Location:/views/matrix_size_input.php/?dir=' . __DIR__);
}

function write_to_errors_file($str)
    {

        require __DIR__ . '/modules/matrix_file_write.php';
        $path = __DIR__ . '/errors.php';
        $errors = error_read_file($path);
        $errors[] = $str;
        error_write_file($errors, $path);
        return;

    }
