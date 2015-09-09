<?php


    $size = $_GET['size'];
    $i = 0;
    $prnum = true;
    while ( $i < $size && $prnum )
    {
        $j = 0;
        while ( $j < $size && $prnum )
        {
            $pointer = 'el_' . $i .$j;
// check entered data on numeric value
            if ( is_numeric ($matrix[$i][$j] = $_POST[$pointer]) ) {

// $matrix1     is a copy of  the $matrix
                $matrix1[$i][$j] = $matrix[$i][$j];
                $inverse_matrix[$i][$j] = 0;
                $one[$i][$j] = 0;
// addition to left side of the $matrix the unit matrix
                $matrix[$i][$j + $size] = 0;
                $j++;

            } else {
                /* the value entered into a matrix cell not numerical*/
                write_to_errors_file
                ('Error : The value = '. $matrix[$i][$j] . ' entered into the matrix cell -' . $i . $j .
                    '- is not numerical.' . "</br>");
                $prnum = false;

            }

        }
        $matrix[$i][$i+$size] = 1;
        $i++;
    }
// inverse matrix finding
// determinant matrix calculation

if ( $prnum ) {
//reduction of a matrix to a triangular look
    $b = 0;
    $sch = 0;// counter of transfer of lines
    $i = 0;
    $pr = true;
    do {
        if ($matrix[$i][$i] != 0) {
            for ($j = $i + 1; $j < $size; $j++) {
                $b = $matrix[$j][$i] / $matrix[$i][$i];
                for ($k = 0; $k < 2 * $size; $k++) {
                    $matrix[$j][$k] = $matrix[$j][$k] - $matrix[$i][$k] * $b;
                }
            }
            $i++;
        } else {
            $l = 1; // line exchange
            do {
                $sch = $sch + 1;
                for ($j = $i; $j < 2 * $size; $j++) {
                    $b = $matrix [$i][$j];
                    $matrix [$i][$j] = $matrix [$i + $l][$j];
                    $matrix [$i + $l][$j] = $b;
                }
                $l++;
                if ($l > $size - $i - 1) {

                    write_to_errors_file('Matrix determinant equals to 0.' . "</br>" .
                        'Inverse matrix could not be found.' . "</br>");
                    $pr = false;

                }
            } while ($matrix [$i][$i] == 0 && $pr);
        }
    } while ($i < $size && $pr);

    if ($pr) {
        $det = 1;
        for ($i = 0; $i < $size; $i++) {
            $det = $det * $matrix [$i][$i];
        }
        $det = $det * st($sch);
// calculation of elements of the inverse matrix
//    $c = 0;
        for ($i = 0; $i < $size; $i++) {
            for ($j = $size - 1; $j > -1; $j--) {
                $c = 0;
                for ($k = 0; $k < $size; $k++) {
                    $c = $c + $matrix [$j][$k] * $inverse_matrix [$k][$i];
                }
                $b = 1 / $matrix [$j][$j];
                $inverse_matrix [$j][$i] = round($b * ($matrix [$j][$i + $size] - $c), 6);

            }
        }

        foreach ($inverse_matrix as $i => $line) {
            foreach ($line as $j => $el) {
                $inverse_matrix[$i][$j] = round($el * $det, 2);
            }
        }
//Multiplication of an initial matrix by the inverse matrix


        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                $c = 0;
                $matrix2 [$i][$j] = round($det * $matrix [$i][$j], 6);
                for ($k = 0; $k < $size; $k++) {
                    $c = $c + $matrix1[$i][$k] * $inverse_matrix [$k][$j];
                }
                $one [$i][$j] = round($c, 6);
            }
        }
        foreach ($one as $i => $line) {
            foreach ($line as $j => $el) {
                $one[$i][$j] = round($el / $det, 2);
            }
        }
        require __DIR__ . '/views/inverse_matrix_output.php';

        require __DIR__ . '/views/output.php';

        output('Matrix Inversion service'. "</br>");
        output('The initial matrix =' . "</br>");
        matrix_output($matrix1, $size);

        output('The initial matrix determinant = ' . $det . "</br>");

        output('The inverse matrix = 1/(' . $det . ') * ' . "</br>");
        matrix_output($inverse_matrix, $size);

        output('The result of multiplication of the initial matrix by the inverse matrix' . "</br>");
        matrix_output($one, $size);


        require_once __DIR__ . '/modules/matrix_file_write.php';
        $path = __DIR__ . '/matrix_safe.php';
//putting up of the $matrix1 in storage matrix_safe.php
        matrix_write($matrix1, $path);
        $path = __DIR__ . '/inverse_matrix_safe.php';
//putting up of the $inverse matrix in storage inverse_matrix_safe.php
        matrix_write($inverse_matrix, $path);
        $path = __DIR__ . '/matrix_determinant_safe.php';
//putting up of the  matrix determinant in storage matrix_determinant_safe.php
        error_write_file($det, $path);
    }
}
require_once __DIR__ . '/modules/matrix_file_write.php';
$path = __DIR__ . '/errors.php';

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
<a href="index.php">NEXT TASK PLEASE</a>
<?php
// (-1)  in degree  n
function st($n) {
    $res = 1;
    if ( $n % 2 == 0 ) { $res = 1;}
    else { $res = -1;}
    return $res;
}

function write_to_errors_file($str)
{

    require_once __DIR__ . '/modules/matrix_file_write.php';
    $path = __DIR__ . '/errors.php';
    $errors = error_read_file($path);
    $errors[] = $str;
    error_write_file($errors, $path);
    return;

}
