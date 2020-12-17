<?php

include('Templates/header.html');

echo '<h2> Quotes</h2> ';

//database connection
include('includes/mysql_connect.php');

if(isset($_GET['random']))
{

    $query = "SELECT id,quote,source,favorite FROM quotes ORDER BY rand() DESC LIMIT 1";

}
elseif(isset($_GET['favorite']))
{
    $query = "SELECT id,quote,source,favorite FROM quotes WHERE favorite=1 ORDER BY rand() DESC Limit 1";
}
else
{
    $query = "SELECT id,quote,source,favorite FROM quotes ORDER BY date_entered DESC LIMIt 1";
}

//run query
if($result = mysqli_query($dbc,$query))
{
    $row = mysqli_fetch_array($result);

    echo "<div><blockquote>&nbsp; {$row['quote']}</blockquote>  - {$row['source']}";

    if($row['favorite'] == 1)
    {
        echo '<strong> This is the favorite</strong>';
    }
    echo '</div>';

    if(is_admin())
    {
        echo "<p><b>Quote Admin: </b> <a href=\"edit_quote.php?id={$row['id']}\">Edit</a> ---
        <a href=\"delete_quote.php?id=\"{$row['id']}\">Delete</a>";
    }
}
else
{
    echo '<p>Could not retrieve data because: ' . mysqli_error($dbc) . '</p><p> The query Ran was: '. $query.'.</p>';
}

//close database connection
mysqli_close($dbc);

echo '<p> <a href="index.php">Latest Quote</a> --- <a href="index.php?random=true">Random Quote</a> ---
    <a href="index.php?favorite=true">Favorite Quote</a></p>';

  include('templates/footer.html');  




?>