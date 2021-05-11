<html>
<head>
<title>MySQL Test</title>
</head>
<body>
<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
   if(! $conn )
      {die('Could not connect');}
   echo 'MySQL connected successfully<br>';
   if(! mysqli_select_db($conn, 'test'))
      {echo 'Could not open database TEST' . '<br>';}
   $sql = 'select * from users';
   $retval = mysqli_query( $conn, $sql );
   if(! $retval )
      {echo 'Could not get data: ' . mysqli_error($conn) . '<br>';}
   echo '<br>';
   // second parameter: MYSQLI_NUM, MYSQLI_ASSOC or MYSQLI_BOTH - 1, 2, 3
   while($row = mysqli_fetch_array($retval, 3))
   {
      echo "login: {$row['login']}" . '<br>';
      echo "pass: {$row['pass']} " . '<br>';
      echo '----------------------' . '<br>';
   }
   mysqli_close($conn);
?>
</body>
</html>