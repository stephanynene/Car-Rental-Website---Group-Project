
<?php
// Get the customer ID and car payment charges due from the URL parameters
$customer_id = $_GET['customer_id'];
$car_payment_chargesdue = $_GET['car_payment_chargesdue'];
?>



<!DOCTYPE html>
<html lang = "en">
    <Head>
        <meta charset ="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" contents="width=device-width, initial-scale-1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="Style.css" />
        <title>Elite Cruisers - Showing charges due</title>
    </Head>
    <body>
        <!--Navbar stuff-->
        <div class="navbar">
            <div class="logo"><a href="HOMEPAGE.php">Elite Cruisers</a></div>
            <ul class="links">
                <li><a href="Change Reservation.html">Change Reservation</a></li>
                <li><a href="delete reservation.html">Delete Reservation</a></li>
                <li><a href="bookingpage.html" class="action_btn">Book Now</a></li>
            </ul>
        </div>
        <!--Redline indicator-->
        <div class="redline"></div>
        <!--Left Text background-->
        <div class="bgfade">
            <!--Left text elements-->
            <div class="singlepoint">
                <h1 class="head">Amount due:</h1><br>
                <p class= "chargesduetext">Total amount due based on number of days booked for car for customer <?php echo $customer_id; ?>: RM<?php echo $car_payment_chargesdue; ?></p><br>
        </div>       
        </div>
    </body>
</html>
