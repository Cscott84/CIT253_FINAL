<?php
define('TITLE','Add a Quote');
include('Templates/header.html');

echo '<h2>Add A Quote</h2>';


//check for admin logged in
if(!is_admin())
{
    echo '<h2>Access Deined!</h2><p> You do not have proper access to this page!</p>';
    include('templates/footer.html');
    exit();
}

// check for submission

if($_SERVER['REQUEST_METHOD'] == "POST")
{
 // handle form
    if(!empty($_POST['quote']) && !empty($_POST['source']))
    {
        //connect to database
        include('includes/mysql_connect.php');

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

        $query = "INSERT into quotes ( quote, source, favorite) VALUES ('$quote','$source','$favorite')";

        mysqli_query($dbc,$query);

        if(mysqli_affected_rows($dbc) == 1)
        {
            echo '<p>Your quote has been added</p>';
        }
        else
        {
            echo '<p>The quote could not be added because: ' . mysqli_error($dbc) . '</p>';
            echo '<p> The query made was: '. $query . '.</p>';
        }

        mysqli_close($dbc);

    }
    else
    {
        echo '<p> please enter a quote and a source </p>';
    }

}

?>

<form action="add_quote.php" method="POST">
 <p><lable>Quote: <textarea name="quote" cols="30" rows="5"></textarea></lable></p>
 <p><label>Source: <input type="text" size="30" name="source"></label></p>   
<p><lable> Is this your favorite?: <input type="checkbox" name="favorite" value="yes"></label></p>
<p><input class="btn btn-info" type="submit" name="submit">
</form>


<?php
include('templates/footer.html');