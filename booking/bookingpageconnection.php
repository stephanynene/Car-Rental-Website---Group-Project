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

$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
$cartype = mysqli_real_escape_string($conn, $_POST['cartype']);
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

// check to see if any form sections are empty
if (empty($firstname) || empty($lastname) || empty($phonenumber) || empty($cartype) || empty($startdate) || empty($enddate)) {
    // Redirect to error page
    header("Location: booking page - 2.html");
    exit();
}

// check startdate is not after enddate
if (strtotime($startdate) > strtotime($enddate)) {
    // Redirect to error page
    header("Location: booking page - 2.html");
    exit();
}


$date1 = date_create($startdate);
$date2 = date_create($enddate);
$diff = date_diff($date1,$date2);
$days = $diff->format("%a");

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
              AND '$startdate' < rd.reservation_detail_enddate
              AND '$enddate' > rd.reservation_detail_startdate";

$result_check = mysqli_query($conn, $sql_check);
$row_check = mysqli_fetch_assoc($result_check);

$car_payment_chargesdue= $days * $car_price;


if ($row_check['num_overlap'] > 0) {
    // overlapping reservation found, redirect to error page with error message
    $error_message = urlencode("Sorry, the $cartype is not available between $startdate and $enddate.");
    header("Location: booking page - 3.php?error_message=$error_message");
    exit();
} else {
    // no overlapping reservation found, proceed with inserting new reservation
    $sql1 = "INSERT INTO reservation_details (reservation_detail_startdate, reservation_detail_enddate) VALUES ('$startdate', '$enddate')";
    $sql2 = "INSERT INTO reservation_car (reservation_car_types, reservation_car_priceperday, reservation_id) VALUES ('$cartype', $car_price, LAST_INSERT_ID())";
    $sql3 = "INSERT INTO customer_details (customer_detail_firstname, customer_detail_lastname, customer_detail_phonenumber, reservation_id) VALUES ('$firstname', '$lastname', '$phonenumber', LAST_INSERT_ID())";
    $sql4 = "INSERT INTO car_payment(car_payment_chargesdue,customer_id) VALUES ($car_payment_chargesdue, LAST_INSERT_ID())";
    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4)) {
        echo "Records added successfully.";
        header("Location: booking page - 1.html");
    } else {
        echo "ERROR: Could not able to execute $sql1 and $sql2 and $sql3 and $sql4. " . mysqli_error($conn);
    }
}

// close connection
mysqli_close($conn);