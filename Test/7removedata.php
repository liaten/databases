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

   $sql = "DELETE FROM ".$tbname." WHERE pass='7777'";

   if ($conn->query($sql) === TRUE) {
      echo "Record(s) removed successfully<br>";
   } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
   }

   $sql = "SELECT user, pass FROM ".$tbname; //показать базу данных

   $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR); //вывод ошибки в случае неверного SQL запроса

   if (mysqli_num_rows($result) > 0) {
   // output data of each row
   echo "DATABASE DOWN BELOW:<br>";
   while($row = mysqli_fetch_assoc($result)) {
      echo "user: ".$row["user"]." - pass: ".$row["pass"]."<br>";
      }
   } else {
      echo "0 results";
   }
?>
</body>
</html>