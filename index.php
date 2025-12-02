<?php
  $host = "localhost" ;
  $user = "root" ; 
  $password = "root" ;
  $databse = "brief_sql" ;
  
  $connnect = new mysqli($host , $user , $password , $databse) ;

  if($connnect -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

?>


<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/css/output.css">
</head>
<body>
  <h1 class="text-3xl font-bold underline  "><?php echo'mohamed' ; ?> </h1>
</body>
</html> 
