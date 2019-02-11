<!DOCTYPE html>
<html>
<body>

<?php

//Setup connection wtih MySQL server
$host="localhost";
$user="root";
$password="";
$database="restaurantdb";
$conn=new mysqli($host,$user,$password,$database);
if($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

//Select statement used to find all Indian Recipes and join their entry in the Recipes Table along with its Indian Table
$sql = "SELECT Recipes.Name, Recipes.Price, Recipes.RecipeDescription, Indian.Comes_With_Naan, Indian.Spiciness
FROM Recipes
INNER JOIN Indian ON Recipes.RecipeID = Indian.RecipeID
WHERE Recipes.RecipeID = Indian.RecipeID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Name</th><th>Price</th><th>Description</th><th>Comes With Naan</th><th>Spiciness(1-4)</th></tr>";
    //output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["Price"]. "</td><td>" . $row["RecipeDescription"]. "</td><td>" . $row["Comes_With_Naan"]. "</td><td>" . $row["Spiciness"]. "</td></tr>";
    }
    echo "</table>";
  //if
} else {
    echo "0 results";
}

//close connection
mysqli_close($conn);


?>

</body>
</html>
