
<!DOCTYPE html>
    <html>

        <head lang="en">
            <meta charset="UTF-8">
            <title></title>
        </head>

        <body>
            <?php

            $dir = $_GET['dir'];

            require $dir . '/modules/matrix_file_write.php';
            $path = $dir . '/errors.php';

            $errors  = error_read_file($path);

            if ( isset($errors[0]) ) {
                foreach ($errors as  $el)
                {

                    echo "</br>";
                    echo $el;

                }
                $errors = [];
                error_write_file($errors,$path);
            }

            ?>
            <h1>Matrix Inversion service</h1>
            <h2>Input matrix size, please.</h2>
            <h2>Matrix size should not be less than 1!<br></h2>
            <form action="/matrix_size_input.php" method="post">
                <input type="number" autofocus required name="size">
                <input type="submit" value="matrix size input"/>
            </form>

        </body>
</html>









