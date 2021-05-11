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
   $dbname = 'PESTEREVVLAD';
   if(! $conn )
      {die('Could not connect');}
   echo 'MySQL connected successfully<br>';
   $sql = 'CREATE DATABASE '.$dbname; //создание базы данных PESTEREVVLAD
   $retval = mysqli_query( $conn, $sql );
   if($retval)
      {echo 'Database '.$dbname.' created successfully<br>';}
   else
      {echo 'Database '.$dbname.' already exists<br>';}
    mysqli_close($conn);
?>
</body>
</html>