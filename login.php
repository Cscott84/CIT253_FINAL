<?php


//process form

$error = false;
$loggedin = false;

if($_SERVER['REQUEST_METHOD'] == "POST")

{
// handle form
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
        if($_POST['email'] == strtolower('me@example.com') && $_POST['password'] == 'testpass')
        {
            setcookie('pete','rock',time() + 3600);
            $loggedin = true;
        }
        else
        {
            $error = 'Please enter the correct email and password that is on file';
        }

    }

    else
    {
        $error = "Please fill out all fields in the form";
    }

}

define('TITLE','Login As Admin');
include('templates/header.html');

if($error)
{
    echo '<p>'. $error . '</p>';
}

if($loggedin)
{
    echo '<p> You are now logged into the best site of quotes in the world';
}
else
{
    echo '<h2> Log in </h2>';
    echo '<form action="login.php" method="POST">
    <p> <label>Email: <input type="email" name="email"></label></p>
    <p><label>Password: <input type="password" name="password"></lable></p>
    <input class="btn btn-info" type="submit" name="submit" value="Log in">
    ';

}

include('Templates/footer.html');





?>
