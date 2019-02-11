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

//Select statement used to find all orders by OrderID made by a Customer by joining Orders with RecipeIDs.
$sql = "SELECT Orders.OrderID, Orders.OrderDate, Orders.OrderTime, Orders_RecipeID.RecipeID
FROM Orders
INNER JOIN Orders_RecipeID ON Orders.OrderID = Orders_RecipeID.OrderID
WHERE Orders.OrderID = '$_POST[orderID]'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Order ID</th><th>Order Date</th><th>Order Time</th><th>Recipe ID</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["OrderID"]. "</td><td>" . $row["OrderDate"]. "</td><td>" . $row["OrderTime"]. "</td><td>" . $row["RecipeID"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}




?>

</body>
</html>
