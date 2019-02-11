<?php

//Setup connection with MySQL server
$host="localhost";
$user="root";
$password="";
$database="restaurantdb";
$conn = new mysqli($host, $user, $password, $database);
if(!$conn) {
 echo '<h1>MySQL Server is not connected</h1>';
}

//creates a random number between 0 and 100,000 to create a random customerID
$customerID = rand(0, 100000);

//inserts dynamic PHP data from a web form to the table Customers
$query = "INSERT INTO Customers(CustomerID, CustomerFirstName, CustomerLastName, CustomerPhoneNumber, CustomerAddress)
VALUES ($customerID,'$_POST[customerfirstname]', '$_POST[customerlastname]', '$_POST[customerphonenumber]', '$_POST[customeraddress]');";

//queries $query
$result = mysqli_multi_query($conn, $query);

//if query successful, returns $customerID. If not, error code is returned
if ($result) {
    echo "Query Succeeded";
    echo "<br>";
    echo "Your Customer ID is " .$customerID. ". Please Remember This Number.";
} else {
    echo "Query Failed..." . mysqli_error($conn);
}

//closes connection
mysqli_close($conn);
?>
