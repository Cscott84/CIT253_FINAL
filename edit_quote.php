<?php
define('TITL','Edit Quote');
include('Templates/header.html');

echo '<h2>Edit Quote</h2>';

// check for admin

if(!is_admin())
{
    echo "<h2>Acess Denied!!</h2><p> you do not have permission to view this page</p>";
    include('Templates/footer.html');
    exit();
}

include('includes/mysql_connect.php');

//get post information

if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{
    
    $query = "SELECT quote,source,favorite FROM quotes WHERE id={$_GET['id']}";

    if($result = mysqli_query($dbc,$query))
    {
        $row = mysqli_fetch_array($result);

        // make form

        echo '<form action="edit_quote.php" method="POST">
        <p><label>Quote: <textarea name="quote" rows="5" cols="30">'. htmlentities($row['quote']).'</textarea></label></p>
        <p><label>Source: <input type="text" name="source" size="30" value="'. htmlentities($row['source']).'"</label></p>
        <p><label>Is this the Favorite?<input type="checkbox" name="favorite" value="yes"';

        if($row['favorite'] == 1)
        {
            echo 'checked="checked"';
        }

        echo '></label></p>
               <input type="hidden" name="id" value="'.$_GET['id'] .'">
               <p><input class="btn btn-info" type="submit" name="submit" value="Update this Quote"></p>';



    }
    else
    {
        echo 'Could not retrieve the request, the error is: ' . mysqli_error($dbc).'<p>The query was: ' . $query . '.</p>';
    }


}
elseif(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0)
{

    // handle form
    $problem = FALSE;
    if(!empty($_POST['quote']) && !empty($_POST['source']))
    {
        $quote = mysqli_real_escape_string($dbc,trim(strip_tags($_POST['quote'])));
        $source = mysqli_real_escape_string($dbc,trim(strip_tags($_POST['source'])));

           if(isset($_POST['favorite']))
           {
               $favorite = 1;
           } 
           else
           {
               $favorite = 0;
           }


    }
    else
    {
        echo '<p>Please submit a quote and a source</p>';
        $problem = TRUE;
    }

    if(!$problem)
    {
        // define query

    $query = "UPDATE quotes SET quote='$quote',source='$source',favorite='$favorite' WHERE id={$_POST['id']}";

    if($result = mysqli_query($dbc,$query))

    {
        echo '<p> The post has been updated</p>';
    }
    else
    {
        echo '<p> Could not update the quote, the error is: '. mysqli_error($dbc) . 'The query was: ' . $query . '.</p>';
    }

    }



}

else
{
    echo '<p> This page has been accessed in error';
}

mysqli_close($dbc);

include('Templates/footer.html');


?>