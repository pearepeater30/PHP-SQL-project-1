<!DOCTYPE html>
<html>
<body>

<?php

//Setup Connection with MySQL server
$host="localhost";
$user="root";
$password="";
$database="restaurantdb";
$conn=new mysqli($host,$user,$password,$database);
if($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

//selects all from Worker
$sql = "SELECT * FROM Worker";
$result = $conn->query($sql);

//if more than zero results found from query, display data as table
if ($result->num_rows > 0) {
    echo "<table><tr><th>Worker ID</th><th>First Name</th><th>Last Name</th><th>Salary</th><th>Date Of Birth</th><th>Age</th><th>Position</th></tr>";
    //output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["WorkerID"]. "</td><td>" . $row["FirstName"]. "</td><td>" . $row["LastName"]. "</td><td>" . $row["Salary"]. "</td><td>" . $row["DateOfBirth"]. "</td><td>" . $row["Age"]. "</td>";
        echo "<td>". $row["Position"]. "</td></tr>";
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
