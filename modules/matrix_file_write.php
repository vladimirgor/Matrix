<?php

function matrix_write($matrix,$path)
{
    $str = serialize($matrix);

    if ( !file_exists($path) )
    {
        return false;
    } else
    {

        file_put_contents($path,$str);
        return true;

    }
}
function error_write_file($ar,$path)
{
    if ( file_exists($path) )
    {
        if ( is_writable($path) )
        {
            file_put_contents($path,$ar);
            return true;
        }
    }

    return false;
}

function error_read_file($path)
{
    if ( file_exists($path) )
    {
        if ( is_readable($path) )
        {

            $ar = file($path);
            return $ar;

        }
    }

    return false;
}