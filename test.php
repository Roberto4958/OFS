<?php
   require_once ‘Scripts/loginInfo.php’;

   $conn = new mysqli($hn, $un, $pw, $db);
   if ($conn->connect_error) die($conn->connect_error);

   $sql = 'select * from items where countyID = 1';
   $result = $conn->query($sql);
   $rows = $result->num_rows;    
   for($i=0; $i < $rows; $i++){
       
       $result->data_seek($i);
       $obj = $result->fetch_array(MYSQLI_ASSOC);
       generateDiv($obj[‘Name’], $obj[‘CategoryName’], $obj[‘Price’], $obj[‘Weight’], $obj[‘Amount’], $obj[‘countyID’]);
   }

   $result->close();
   $conn->close();


   function generateDiv($name, $category, $price, $weight, $amount){
       echo "name: $name, Category: $category, Price: $price, weight: $weight, amount: $amount </br>";
   }

?>