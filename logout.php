<?php


if(isset($_COOKIE['pete']))
{
    setcookie('pete',false, time() - 3000);

}


define('TITLE','LOGOUT');
include('Templates/header.html');
echo '<p> You are now logged out </p>';
echo'<p> <a href="login.php">Log in</a></p>';

include('Templates/footer.html');

?>