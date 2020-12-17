<?php

define('TITLE','View Quotes');
include('Templates/header.html');

echo '<h2>All Quotes</h2>';

// check for admin
if(!is_admin())
{
    echo '<h2>Access Denied!</h2><p>You do not have permission to acess this page</p>';
    include('Templates/footer.html');
    exit();
}

//include database

include('includes/mysql_connect.php');

$query = "SELECT id,quote,source,favorite FROM quotes ORDER BY date_entered DESC";

if($result = mysqli_query($dbc,$query))
{
    while($row = mysqli_fetch_array($result))
    {
        echo "<div><blockquote>&nbsp;{$row['quote']}</blockquote> - {$row['source']}\n";

        if($row['favorite'] == 1)
        {
          echo '<strong> This is the favorite </strong>';  

        }

        // add edit and delete

        echo "<p><b>Quote Admin:</b> <a href=\"edit_quote.php?id={$row['id']}\">Edit Quote</a>---" ;
        echo "<a href=\"delete_quote.php?id={$row['id']}\">Delete Quote</a></p></div>\n";
        echo '<hr>';

    }

}

else
{

    echo "<p>Could not retrive data because: " . mysqli_error($dbc) . "</p><br><p> The Query Ran was:" . $query ."</p>";
}

//close database connection
mysqli_close($dbc);


include('templates/footer.html');




?>