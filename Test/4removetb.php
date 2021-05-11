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
   $sql = 'DROP TABLE '.$tbname; //удаление таблицы PVLAD
   $retval = mysqli_query( $conn, $sql );
   if($retval)
      {echo 'Table '.$tbname.' dropped successfully<br>';}
   else
      {echo 'Table '.$tbname.' was not dropped<br>';}
   mysqli_close($conn);
?>
</body>
</html>