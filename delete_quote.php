<?php

define('TITLE','Delete Quote');
include('Templates/header.html');

echo '<h2>Delete Quote</h2>';
// check for admin

if(!is_admin())
{
    echo 'Acess Denied!<p>You do not have permission to access this page.</p>';
    include('Templates/footer.html');
    exit();
}

//add connection to database
include('includes/mysql_connect.php');

if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{
    $query = "SELECT quote,source,favorite FROM quotes WHERE id={$_GET['id']}";
    
    if($result = mysqli_query($dbc,$query))
    {
        $row = mysqli_fetch_array($result);

        // make form
        echo '<form action="delete_quote.php" method="POST">
        <p>Are you sure you want to delete this quote?</p>
        <div><blockquote>'. $row['quote'].'</blockquote>  ---' .$row['source'];

        if($row['favorite'] == 1)
        {
            echo 'The favorite quote';
        }

        echo '</div><br><input type="hidden" name="id" value="'.$_GET['id'].'">
        <p><input class="btn btn-info" type="submit" name="submit" value="Delete this Quote"></p>
        </form>';
    }

    else
    {
        echo '<p>Could Not retrieve the quote, there was an error: '. mysqli_error($dbc) . '</p><p>The query was: ' . $query . '.</p>';
    }

}
elseif(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0)
{
    $query = "DELETE FROM quotes WHERE id={$_POST['id']} LIMIT 1";
    $result = mysqli_query($dbc,$query);

    if(mysqli_affected_rows($dbc) == 1)
    {
        echo '<p> The quote has been deleted</p>';
    }
    else
    {
        echo '<p>Could not delete entry because: '. mysqli_error($dbc) . '.</p><p> The query was:' . $query.'.</p>';
    }



}
else
{
    echo ' This Page has been accessed in error.';
}

    mysqli_close($dbc);
    include("Templates/footer.html");



?>