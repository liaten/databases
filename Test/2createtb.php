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
   $tbname = 'PVLAD';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
   if(! $conn )
      {die('Could not connect');}
   echo 'MySQL connected successfully and '.$dbname.' is database now<br>';
   $sql = 'CREATE TABLE '.$tbname.' (user VARCHAR(30), pass VARCHAR(30))'; //удаление таблицы PVLAD
   $retval = mysqli_query( $conn, $sql );
   if($retval)
      {echo 'Table '.$tbname.' created successfully<br>';}
   else
      {echo 'Table '.$tbname.' already exists<br>';}
   mysqli_close($conn);
?>
</body>
</html>