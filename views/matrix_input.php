<?php

function matrix_input($size)
{
    ?>
    <!DOCTYPE html>
    <html>
    <head lang="en">
        <link rel="stylesheet" href="/style.css" type="text/css"/>
        <meta charset="UTF-8">
        <title>MATRIX_INPUT</title>
    </head>
    <body>
    <h1>Matrix Inversion service</h1>
    <h3>Now  input matrix, please.</h3>
    <?php

    $i = 0;
    ?>

    <form action="/inv_matrix_finding.php?size=<?php echo $size;?>" method="post">

        <?php while ($i < $size) :
            $j = 0;

            while ($j < $size) :
                ?>
                <span>
                    <input type="text" autofocus required name="<?php echo 'el_' . $i . $j?>" value="">
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
        <input type="submit" value="matrix  input"/>

    </form>


    </body>
    </html>
<?php

//    return;
}