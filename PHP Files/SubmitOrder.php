<?php

//Setup connection with MySQL database
$host="localhost";
$user="root";
$password="";
$database="restaurantdb";
$conn = new mysqli($host, $user, $password, $database);
if($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

function myErrorHandler($errno, $errstr, $errfile, $errline) {

}

set_error_handler('myErrorHandler', E_NOTICE | E_STRICT);
$indian = $_POST['Indian'];
$western = $_POST['Western'];
$chinese = $_POST['Chinese'];
//create a random number between 0-1,000,000 for $orderID
$orderID = rand(0, 1000000);

//sees if CustomerID that is typed into the form exists in the Customers Database
$customerIDexistence = "SELECT CustomerID FROM Customers WHERE (CustomerID = '$_POST[customerID]');";
$result = mysqli_query($conn, $customerIDexistence);

//if there are none, returns error message and closes connection
if($result->num_rows == 0)
  {
    echo "CustomerID does not exist, please try again";
    echo "<br>";
    echo "<br>";
    mysqli_close($conn);
    exit;
  }

//if no selections are made in the menu, then returns error message and closes connection
if(!isset($indian) && !isset($western) && !isset($chinese))
  {
    echo ("You did not select anything, select at least one thing to proceed");
    mysqli_close($conn);
    exit;
  }

//Creates an Order in Orders
$query = "INSERT INTO Orders(OrderID, OrderDate, OrderTime, CustomerID)
VALUES ($orderID, CURRENT_TIMESTAMP(), NOW(), '$_POST[customerID]');";
  if(!mysqli_query($conn, $query)){
    echo "Query Failed...";
  }
  else{
    echo "Your order number is " .$orderID. ". Please Remember this!";
    echo "<br>";
    echo "<br>";
  }

//detects if there are any items selected in the Indian Menu. If there aren't, sends an alert
if(!isset($indian))
  {
    echo("You didn't select any boxes for Indian.");
    echo "<br>";
    echo "<br>";
  }
else{
//if there are items selected in the Indian Menu, loops through each value and inserts into Orders_RecipeID.
$i = count($indian);
for($j = 0; $j < $i; $j++){
  $sql = "INSERT INTO Orders_RecipeID(OrderID, RecipeID) VALUES ($orderID, $indian[$j]);";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
      echo "Query Failed...";
    }
  }
}

//detects if there are any items selected in the Western Menu. If there aren't, sends an alert
if(!isset($western))
  {
    echo("You didn't select any boxes Western.");
    echo "<br>";
    echo "<br>";
  }
else{
//if there are items selected in the Western Menu, loops through each value and inserts into Orders_RecipeID.
$i = count($western);
for($j = 0; $j < $i; $j++){
  $sql = "INSERT INTO Orders_RecipeID(OrderID, RecipeID) VALUES ($orderID, $western[$j]);";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
      echo "Query Failed...";
    }
  }
}

//detects if there are any items selected in the Chinese  Menu. If there aren't, sends an alert
if(!isset($chinese))
  {
    echo("You didn't select any boxes for Chinese.");
    echo "<br>";
    echo "<br>";
  }
else{
//if there are items selected in the Chinese Menu, loops through each value and inserts into Orders_RecipeID.
$i = count($chinese);
for($j = 0; $j < $i; $j++){
  $sql = "INSERT INTO Orders_RecipeID(OrderID, RecipeID) VALUES ($orderID, $chinese[$j]);";
$result = mysqli_query($conn, $sql);
  if (!$result) {
      echo "Query Failed...";
    }
  }
}

//closes connection
mysqli_close($conn);

?>
