<!DOCTYPE html>
<html>
<body>

<?php

//Setup connection with MySQL database
$host="localhost";
$user="root";
$password="";
$database="restaurantdb";
$conn=new mysqli($host,$user,$password,$database);
if($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

//Select statement used to find all orders by CustomerID made by a Customer by joining Orders with Customers and left joining the RecipeIDs with them.
$sql = "SELECT Customers.CustomerID, Orders.OrderID, Orders.OrderDate, Orders.OrderTime, Orders_RecipeID.RecipeID
FROM Orders
INNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID
LEFT JOIN Orders_RecipeID ON Orders.OrderID = Orders_RecipeID.OrderID
WHERE Customers.CustomerID = '$_POST[customerID]'";
$result = $conn->query($sql);

//If more than zero results are found from the query, display data from query as table
if ($result->num_rows > 0) {
    echo "<table><tr><th>Customer ID</th><th>Order ID</th><th>Order Date</th><th>Order Time</th><th>Recipe ID</th></tr>";
    //output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["CustomerID"]. "</td><td>" . $row["OrderID"]. "</td><td>" . $row["OrderDate"]. "</td><td>" . $row["OrderTime"]. "</td><td>" . $row["RecipeID"]."</td></tr>";
    }
    echo "</table>";
  //if no results are found, echo "0 results"
} else {
    echo "0 results";
}

mysqli_close($conn);


?>

</body>
</html>
