<?php


// function to check for admin

function is_admin($name='***',$value='***')
{
    if(isset($_COOKIE[$name]) && ($_COOKIE[$name] == $value))
    {
        return true;
    }
    else
    {
        return false;
    }

}

?>
