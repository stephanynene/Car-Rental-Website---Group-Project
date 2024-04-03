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

$reservation_id = mysqli_real_escape_string($conn, $_POST['reservationNumber']);
$cartype = mysqli_real_escape_string($conn, $_POST['carType']);
$startdate = $_POST['startDate'];
$enddate = $_POST['endDate'];
$date1 = date_create($startdate);
$date2 = date_create($enddate);
$diff = date_diff($date1,$date2);
$days = $diff->format("%a");

// check in case startdate is after enddate
if (strtotime($startdate) > strtotime($enddate)) {
    // Redirect to error page
    header("Location: Change Reservation - 3.html");
    exit();
}

// calculate car price based on type
switch ($cartype) {
    case 'Rolls Royce Phantom (Blue)':
        $car_price = 9800;
        break;
    case 'Bentley Continental Flying Spur (White)':
        $car_price = 4800;
        break;
    case 'Mercedes Benz CLS 350 (Silver)':
        $car_price = 1350;
        break;
    case 'Jaguar S Type (Champagne)':
        $car_price = 1350;
        break;
    case 'Ferrari F430 Scuderia (Red)':
        $car_price = 6000;
        break;
    case 'Lamborghini Murcielago LP640 (Matte Black)':
        $car_price = 7000;
        break;
     case 'Porsche Boxster (White)':
        $car_price = 2800;
        break;
    case 'Lexus SC430 (Black)':
        $car_price = 1600;
        break;
     case 'Jaguar MK 2 (White)':
        $car_price = 2200;
        break;
    case 'Rolls Royce Silver Spirit Limousine (Georgian Silver)':
        $car_price = 3200;
        break;
    case 'MG TD (Red)':
        $car_price = 2500;
        break;
    default:
        $car_price = 0;
}

// check car availability
$sql_check = "SELECT COUNT(*) AS num_overlap
              FROM reservation_details rd
              JOIN reservation_car rc ON rd.reservation_id = rc.reservation_id
              WHERE rc.reservation_car_types = '$cartype'
              AND rd.reservation_id != '$reservation_id'
              AND '$startdate' < rd.reservation_detail_enddate
              AND '$enddate' > rd.reservation_detail_startdate";

$result_check = mysqli_query($conn, $sql_check);
$row_check = mysqli_fetch_assoc($result_check);

if ($row_check['num_overlap'] > 0) {
    // overlapping reservation found, do something (e.g. display error message)
    header("Location: Change Reservation - 4.html");
    exit();  
} else {
    // no overlapping reservation found, proceed with inserting new reservation    
    $sql1 = "UPDATE reservation_details SET reservation_detail_startdate = '$startdate' WHERE reservation_id = '$reservation_id';";
    $sql2 = "UPDATE reservation_details SET reservation_detail_enddate = '$enddate' WHERE reservation_id = '$reservation_id';";
    $sql3 = "UPDATE reservation_car SET reservation_car_types = '$cartype' WHERE reservation_id = '$reservation_id';";
    $sql4 = "UPDATE reservation_car SET reservation_car_priceperday = '$car_price' WHERE reservation_id = '$reservation_id';";

    // Get the customer_id from customer_details table using the reservation_id
    $sql_get_customer_id = "SELECT customer_id FROM customer_details WHERE reservation_id = '$reservation_id';";
    $result_customer_id = mysqli_query($conn, $sql_get_customer_id);
    $row_customer_id = mysqli_fetch_assoc($result_customer_id);
    $customer_id = $row_customer_id['customer_id'];

    // Update the car_payment_chargesdue in the car_payment table using the obtained customer_id
    $sql5 = "UPDATE car_payment SET car_payment_chargesdue = $car_price * $days WHERE customer_id = '$customer_id';";

    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4) && mysqli_query($conn, $sql5)) {
        header("Location: Change Reservation - 2.html");
        exit();            
            /* Debugging information
            echo "<br>Reservation ID: $reservation_id";
            echo "<br>Car Type: $cartype";
            echo "<br>Start Date: $startdate";
            echo "<br>End Date: $enddate";
            echo "<br>Customer ID: $customer_id";
            echo "<br>Car Payment Charges Due: " . ($car_price * $days);*/

    } else {
        echo "ERROR: Could not able to execute $sql1, $sql2, $sql3, and $sql4. " . mysqli_error($conn);
        header("Location: Change Reservation - 3.html");
        exit();            
            /* Debugging information
            echo "<br>Reservation ID: $reservation_id";
            echo "<br>Car Type: $cartype";
            echo "<br>Start Date: $startdate";
            echo "<br>End Date: $enddate";
            echo "<br>Customer ID: $customer_id";
            echo "<br>Car Payment Charges Due: " . ($car_price * $days);*/

    }
}

// close connection
mysqli_close($conn);
?>