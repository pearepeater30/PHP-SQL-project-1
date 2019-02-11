<?php

//Setup connection between MySQL server
$host="localhost";
$user="root";
$password="";
$database="restaurantdb";
$conn = new mysqli($host, $user, $password, $database);
if(!$conn) {
 echo '<h1>MySQL Server is not connected</h1>';
}

//Delete from multiple tables, has to delete from Chef first otherwise query will fail.
$query = "DELETE FROM Chef
WHERE (WorkerID = '$_POST[workerID]');";

$query .= "DELETE FROM Worker
WHERE (WorkerID = '$_POST[workerID]');";

$result = mysqli_multi_query($conn, $query);

//return errors if there are any
if ($result) {
    echo "Query Succeeded";
} else {
    echo "Query Failed..." . mysqli_error($conn);
}
//closes connection
mysqli_close($conn);
?>
