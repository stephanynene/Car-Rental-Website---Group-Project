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
// check if user clicked submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the entered customer ID
    $customer_id = $_POST['customerid'];

    // sql to get the car payment charges due for the entered customer ID
    $sql = "SELECT car_payment_chargesdue FROM car_payment WHERE customer_id = $customer_id";
    $result = $conn->query($sql);

    // check if query successful
    if ($result->num_rows > 0) {
        // Fetch the car payment charges due for the entered customer ID
        $row = $result->fetch_assoc();
        $car_payment_chargesdue = $row["car_payment_chargesdue"];
        // Redirect to the result page
        $url = "showingchargesdue.php?" . http_build_query(array(
            'customer_id' => $customer_id,
            'car_payment_chargesdue' => $car_payment_chargesdue
        ));
        header("Location: $url");
        exit();
    } else {
        header("Location: showingchargesdue - 1.html");
    }
}

// Close the database connection
$conn->close();
?>