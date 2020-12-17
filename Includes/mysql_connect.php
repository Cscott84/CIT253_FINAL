<?php

// connect to mysql database and set charset for security functions

define('HOST','localhost');
define('USER','root');
define('PW','password');
define('DB','myquotes');

$dbc = mysqli_connect(HOST,USER,PW,DB);

mysqli_set_charset($dbc,'utf8');



?>