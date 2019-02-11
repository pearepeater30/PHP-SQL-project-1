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

//Select statement used to find all Western Recipes and join their entry in the Recipes Table along with its Western Table
$sql = "SELECT Recipes.Name, Recipes.Price, Recipes.RecipeDescription, Western.Comes_With_Chips
FROM Recipes
INNER JOIN Western ON Recipes.RecipeID = Western.RecipeID
WHERE Recipes.RecipeID = Western.RecipeID";
$result = $conn->query($sql);

//If more than zero results are found from the query, display data from query as table
if ($result->num_rows > 0) {
    echo "<table><tr><th>Name</th><th>Price</th><th>Description</th><th>Comes With Chips</th></tr>";
    //output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["Price"]. "</td><td>" . $row["RecipeDescription"]. "</td><td>" . $row["Comes_With_Chips"]. "</td></tr>";
    }
    echo "</table>";
  //if no results are found, echo "0 results"
} else {
    echo "0 results";
}

//close connection
mysqli_close($conn);


?>

</body>
</html>
