<?php
// establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elite_cruisers";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$reservationid = mysqli_real_escape_string($conn, $_POST['reservationid']);


$query1 = "DELETE FROM car_payment WHERE customer_id IN 
           (SELECT customer_id FROM customer_details WHERE reservation_id = '$reservationid')";
$result1 = mysqli_query($conn, $query1);
if (!$result1) {
    die("Delete query failed: " . mysqli_error($conn));
}

$query2 = "DELETE FROM customer_details WHERE reservation_id = '$reservationid'";
$result2 = mysqli_query($conn, $query2);
if (!$result2) {
    die("Delete query failed: " . mysqli_error($conn));
}

$query3 = "DELETE FROM reservation_car WHERE reservation_id = '$reservationid'";
$result3 = mysqli_query($conn, $query3);
if (!$result3) {
    die("Delete query failed: " . mysqli_error($conn));
}


$query4 = "DELETE FROM reservation_details WHERE reservation_id = '$reservationid'";
$result4 = mysqli_query($conn, $query4);
if (!$result4) {
    die("Delete query failed: " . mysqli_error($conn));
}

// check if any error
if (mysqli_affected_rows($conn) == 0) {
    header("Location: delete reservation - 2.html");
    exit();
}

echo "Data of reservation ID $reservationid deleted successfully";
mysqli_close($conn);

header("Location: delete reservation - 1.html");
exit();