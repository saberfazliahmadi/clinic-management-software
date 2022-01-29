<?php
echo '
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello '.$user.'</title>
</head>
<body>
HELLO DEAR '.$user.'
<hr>
</body>
</html>
The Number of Result Which is exist in database is:'
.$number_of_results.'<br>' ;

foreach ( $users as $key )
{
    echo 'Email address: '.$key->email.'<br>
    Name: '.$key->name.'<br>
    Password: '.$key->password.'<br>
    <hr>' ;
}

?>