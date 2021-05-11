<html>
<head>
<title>MySQL Test</title>
</head>
<body>
<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'PESTEREVVLAD';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
   if(! $conn )
      {die('Could not connect');}
   echo 'MySQL connected successfully and '.$dbname.' is database now<br>';
   $sql = 'DROP DATABASE '.$dbname; //удаление базы данных PESTEREVVLAD
   $retval = mysqli_query( $conn, $sql );
   if($retval)
      {echo 'Database '.$dbname.' dropped successfully<br>';}
   else
      {echo 'Database '.$dbname.' doesn\'t exist to drop it. Create database first<br>';}
   mysqli_close($conn);
?>
</body>
</html>