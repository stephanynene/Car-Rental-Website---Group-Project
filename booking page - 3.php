<!DOCTYPE html>
<html lang = "en">
    <Head>
        <meta charset = "UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" contents="width=device-width, initial-scale-1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="Style.css" />
        <title>Elite Cruisers - error</title>
    </Head>
    <body>
        <!--Navbar stuff-->
        <div class="navbar">
            <div class="logo"><a href="HOMEPAGE.php">Elite Cruisers</a></div>
            <ul class="links">
                <li><a href="Change Reservation.html">Change Reservation</a></li>
                <li><a href="deletereservation.html">Delete Reservation</a></li>
            </ul>
        </div>
        <div>
            <!--Page Content-->
            <div class="bgfade">
            <h1 class="singlepoint">
    <?php
    if (isset($_GET['error_message'])) {
        $error_message = $_GET['error_message'];
        echo urldecode($error_message);
    }
    ?>
</h1>

            </div>
        </div>
    </body>
</html>