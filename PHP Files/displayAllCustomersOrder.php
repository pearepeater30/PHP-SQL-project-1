<!DOCTYPE html>
<html>
<body>

<?php

//Setup connection with MySQL server
$host="localhost";
$user="root";
$password="";
$database="restaurantdb";
$conn=new mysqli($host,$user,$password,$database);
if($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

//Subquery within SELECT statement which finds the count of Orders.OrderID to find the total amount of orders
$sql = "SELECT CustomerID, CustomerFirstName, CustomerLastName, (SELECT COUNT(Orders.OrderID) FROM Orders WHERE Orders.CustomerID = 12345) AS OrderCount
        FROM Customers";
$result = $conn->query($sql);

//if more than 0 results are found from the query, display data as a table
if ($result->num_rows > 0) {
    echo "<table><tr><th>Customer ID</th><th>Customer First Name</th><th>Customer Last Name</th><th>Order Count</th></tr>";
    //output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["CustomerID"]. "</td><td>" . $row["CustomerFirstName"]. "</td><td>" . $row["CustomerLastName"]. "</td><td>" . $row["OrderCount"]. "</td></tr>";
    }
    echo "</table>";
  //if no data found, echo '0 results'
} else {
    echo "0 results";
}

mysqli_close($conn);

?>

</body>
</html>
