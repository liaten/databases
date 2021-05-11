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
   $sql = 'CREATE DATABASE TEST';
   $retval = mysqli_query( $conn, $sql );
   if(! $retval )
      {echo 'Could not create database: ' . mysqli_error($conn) . '<br>';}
   else
      {echo 'Database TEST created successfully<br>';}
   if(! mysqli_select_db($conn, 'test'))
      {echo 'Could not open database TEST' . '<br>';}
   $sql = 'create table users(login varchar(20), pass varchar(20))';
   $retval = mysqli_query( $conn, $sql );
   if(! $retval )
      {echo 'Could not create table: ' . mysqli_error($conn) . '<br>';}
   else
      {echo 'Table USERS created successfully<br>';}
   mysqli_close($conn);
?>
</body>
</html>