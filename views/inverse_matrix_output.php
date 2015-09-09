<?php

function matrix_output($matrix,$size)
{
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <link rel="stylesheet" href="/style.css" type="text/css"/>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

    <?php
    $i = 0;
    while ( $i < $size) :
        $j = 0;

        while ($j < $size) :

            ?>
            <span>
                <span class = "element">
                    <?php echo $matrix[$i][$j];?>
                </span>
                <p><?php echo $i . $j;?></p>
            </span>
            <?php
            $j++;
        endwhile;
        ?>
        <br>
        <?php $i++;

    endwhile;
    ?>
</body>
</html>

<?php
    return;
}
