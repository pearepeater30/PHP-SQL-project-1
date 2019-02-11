<?php

//Setup connection with MySQL server
$host="localhost";
$user="root";
$password="";
$database="restaurantdb";
$mysqli = new mysqli($host, $user, $password, $database);
if(!$mysqli) {
 echo '<h1>MySQL Server is not connected</h1>';
}

//sees if WorkerID that is typed into the form exists in the Worker Database
$customerIDexistence = "SELECT WorkerID FROM Worker WHERE (WorkerID = '$_POST[workerID]');";
$result = mysqli_query($conn, $customerIDexistence);

//if there are, returns error message and closes connection
if($result->num_rows > 0)
  {
    echo "WorkerID already exists, please try again";
    echo "<br>";
    echo "<br>";
    mysqli_close($conn);
    exit;
  }


//Insert dynamic PHP data from a web form into Worker and Cashier Tables
$query = "INSERT INTO Worker(WorkerID, FirstName, LastName, Age, Salary, DateOfBirth, Position)
VALUES ('$_POST[workerID]','$_POST[firstname]', '$_POST[lastname]', TIMESTAMPDIFF(YEAR,'$_POST[dateofbirth]',CURDATE()), '$_POST[salary]', '$_POST[dateofbirth]', '$_POST[position]');";

$query .= "INSERT INTO Cashier(WorkerID, CashierID, CashierPoint)
VALUES ('$_POST[workerID]','$_POST[cashierID]', '$_POST[cashierpoint]');";

//Query multiple SQL statements
$result = mysqli_multi_query($mysqli, $query);

//return error if there are any.
if ($result) {
    echo "Query Succeeded";
} else {
    echo "Query Failed..." . mysqli_error($mysqli);
}

//closes connection
mysqli_close($mysqli);
?>
