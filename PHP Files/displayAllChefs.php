<!DOCTYPE html>
<html>
<body>

<?php

//Setup connection to MySQL server
$host="localhost";
$user="root";
$password="";
$database="restaurantdb";
$conn=new mysqli($host,$user,$password,$database);
if($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

//Select statement used to find all Chefs and join their entry in the Worker Table along with its Chef Table
$sql = "SELECT Worker.WorkerID, Worker.FirstName, Worker.LastName, Worker.DateOfBirth, Worker.Age, Worker.Salary, Worker.Position, Chef.ChefID, Chef.Specialty
FROM Worker
INNER JOIN Chef ON Worker.WorkerID = Chef.WorkerID
WHERE Worker.WorkerID = Chef.WorkerID";
$result = $conn->query($sql);

//checks if the number of entries is bigger than 0, if it is, then output data found
if ($result->num_rows > 0) {
    echo "<table><tr><th>Worker ID</th><th>Name</th><th>Salary</th><th>Age</th><th>Date Of Birth</th><th>Position</th><th>Chef ID</th><th>Chef Specialty</th></tr>";
    //output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["WorkerID"]. "</td><td>" . $row["FirstName"]. " " . $row["LastName"]. "</td><td>" . $row["Salary"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["DateOfBirth"]. "</td>";
        echo "<td>" . $row["Position"]. "</td><td>" . $row["ChefID"]. "</td><td>" . $row["Specialty"]. "</td></tr>";
    }
    echo "</table>";
  //if no data found, echo: '0 results'
} else {
    echo "0 results";
}
//closes connection
mysqli_close($conn);



?>

</body>
</html>
