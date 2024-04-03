<!DOCTYPE html>

<html lang="en">
<head>
    <title></title>
    <link rel="stylesheet" href="backup_css.css">
    <meta charset = "UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" contents="width=device-width, initial-scale-1.0" />



</head>
<body>

   <div class="wrapper">
    <div class="main">
      <div class="navbar">

          <div class="logo"><img src="headerlogo.PNG" alt= "logoattheheader" style="height:80px; width:200px;margin:20px"/></div>
          <div class="menu">
          <ul >
             <li><a href="#aboutus">About us</a></li>
             <li><a href="#services">Services</a></li>
             <li><a href="#cars">Cars</a></li>
             <li><a href="#inquiry">Enquiry</a></li>
             <li><a href="login page.php">Logout</a></li>

          </ul>
          <img src="usericon.png" class="user-pic" onclick="toggleMenu()" >
          <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">

              <a href="" class="sub-menu-link">

              <p><?php

// establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elite_cruisers";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT employee_detail_firstname,employee_detail_lastname FROM employee_details";
$result = $conn->query($sql);

// Display first name and last name
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo " " . $row["employee_detail_firstname"]. " " . $row["employee_detail_lastname"]. "<br>";
  }
} else {
  echo "0 results";
}

// Close the database connection
mysqli_close($conn);

?>
 </p>
                <span> > </span> </a>
                <a href="#inquiry" class="sub-menu-link">
                  <p> Staff User </p>
                  <span> > </span></a>
                   

            </div>

          </div>

        </div>

      </div>



        <div class="content">

                <div class="form">

                  <!--  <h1>ELITE <br> CRUISERS</h1>

                    <h2> Luxury Car Rentals </h2>-->
                    <img src="LOGO.PNG" alt= "logoatthecenter" style="height:400px"/>

                    <div class="icons">
                        <a href="https://www.facebook.com"><ion-icon name="logo-facebook"></ion-icon></a>
                        <a href="https://www.instagram.com"><ion-icon name="logo-instagram"></ion-icon></a>
                        <a href="https://twitter.com/home"><ion-icon name="logo-twitter"></ion-icon></a>
                        <a href="https://www.google.com"><ion-icon name="logo-google"></ion-icon></a>
                        <a href="https://www.snapchat.com/en-GB"><ion-icon name="logo-snapchat"></ion-icon></a>
                    </div>

                </div>
                    </div>
                </div>
                <div class="services">

                  <h1 id="services"> Services </h1>
                  <br>
                  <br>
                  <br>
                  <a href="bookingpage.html">
                  <button class="button-1" role="button">MAKE RESERVATION</button>
                </a>
                <a href="delete reservation.html">
                  <button class="button-1" role="button">DELETE RESERVATION</button>
                </a>
              <a href="Change Reservation.html">
                  <button class="button-1" role="button">UPDATE RESERVATION</button>
</a>
<a href="chargesdue.html">
    <button class="button-1" role="button">CHECK CHARGES</button>
</a>
</div>
                <div class="desc">
<p id="aboutus"></p>
                  <div class="title-text">

                  <h1 > About us </h1>

                  <p > Demand nothing but the best? We've got you covered!
                    From sports cars to luxury SUVs, Elite Cruisers offers
                    an unparalleled selection of top-of-the-line vehicles that
                    will make your driving experience unforgettable. When you rent a car from Elite Cruisers,
                    you're not just renting a vehicle – you're renting an experience. The company's fleet
                    consists of only the finest cars, each meticulously maintained to ensure that every ride
                    is as smooth as possible. From the engine to the exterior, every aspect of the vehicle is in top condition, guaranteeing an enjoyable driving experience every time.
                     Our fleet of impeccable cars is guaranteed
                      to impress even the most discerning of customers.
                      Whether you're looking to make a grand entrance at a
                       special event or simply want to cruise in style on
                       your next road trip, we are at your service.
                      Elite Cruisers offers competitive pricing, making luxury car rental
                      accessible to more people than ever before. With our range of vehicles
                      and excellent customer service, the company is the perfect choice for anyone
                       who wants to travel in style and comfort without breaking the bank. <b>Book your ride
                       today and experience
                        the pinnacle of automotive excellence with Elite Cruisers.</b>
                  </p>

              </div>
</div>







</div>
                <div class = "column1">
                  <h1 id="cars"> Our Cars </h1>
                  <div class="colleft" >
                    <div class="slider" id="main-slider">
	<div class="slider-wrapper">
		<img src="car1.png" alt="First" class="slide" />
		<img src="car2.png" alt="Second" class="slide" />
		<img src="car3.png" alt="Third" class="slide" />
    <img src="car4.png" alt="Third" class="slide" />
    <img src="car5.png" alt="Third" class="slide" />
    <img src="car6.png" alt="Third" class="slide" />
	</div>
</div>
<script>
(function() {

	function Slideshow( element ) {
		this.el = document.querySelector( element );
		this.init();
	}

	Slideshow.prototype = {
		init: function() {
			this.wrapper = this.el.querySelector( ".slider-wrapper" );
			this.slides = this.el.querySelectorAll( ".slide" );
			this.previous = this.el.querySelector( ".slider-previous" );
			this.next = this.el.querySelector( ".slider-next" );
			this.index = 0;
			this.total = this.slides.length;
			this.timer = null;

			this.action();
			this.stopStart();
		},
		_slideTo: function( slide ) {
			var currentSlide = this.slides[slide];
			currentSlide.style.opacity = 1;

			for( var i = 0; i < this.slides.length; i++ ) {
				var slide = this.slides[i];
				if( slide !== currentSlide ) {
					slide.style.opacity = 0;
				}
			}
		},
		action: function() {
			var self = this;
			self.timer = setInterval(function() {
				self.index++;
				if( self.index == self.slides.length ) {
					self.index = 0;
				}
				self._slideTo( self.index );

			}, 3000);
		},
		stopStart: function() {
			var self = this;
			self.el.addEventListener( "mouseover", function() {
				clearInterval( self.timer );
				self.timer = null;

			}, false);
			self.el.addEventListener( "mouseout", function() {
				self.action();

			}, false);
		}


	};

	document.addEventListener( "DOMContentLoaded", function() {

		var slider = new Slideshow( "#main-slider" );

	});


})();

let SubMenu= document.getElementById("subMenu");
function toggleMenu(){
  subMenu.classList.toggle("open-menu");
}

</script>
                  </div>
                </div>
<div>
  <div class="colright">
    <div class="cartitle">
      <div class="zoom">
        <a href="sportscarpage.html">
    <h3 >Sports Cars </h3></div> </a>
    <p>

        From the sleek and stylish Porsche 911 Carrera to the iconic Lamborghini Huracan, we have a wide variety of options to choose from.
        Whether you're looking for power, style, or both, our range of
        sports cars is sure to satisfy your need for speed.

    </p>
    <div class="zoom">
        <a href="luxuriouscarspage.html">
    <h3>Luxury Cars</h3> </div></a>
    <p>
    From the powerful and luxurious BMW 7 Series to
      the sleek and stylish Mercedes-Benz S-Class, we have a wide selection of options to choose from.
      Whether you're looking for comfort, performance, or sheer opulence, our range of luxury cars is sure to meet your every need and exceed your every expectation.




    </p>
    <div class="zoom">
        <a href="classiccarspage.html">
    <h3>Classics Cars</h3></div> </a>
    <p> From the timeless beauty of the Ford Mustang
    Convertible to the iconic styling of
    the Chevrolet Camaro SS, we have a variety of options to choose from. Whether you're looking to relive the glory days of the past or experience the timeless beauty of classic cars, our range of vintage vehicles is sure to satisfy your every desire.  </p>
</div>
    </div>
  </div>



    </div>

  <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

</div>
</div>
</div>

<div class="footer">
  <div class ="footer1">

    <div class="footerform">
      <h2 id="inquiry"> Inquiries </h2>
      <div class = "formleft">

          <input class="contact" type="text" id="fname" name="firstname" placeholder="Customer name.." required><br   />

          <input class="contact" type="text" id="lname" name="lastname" placeholder="Customer last name.." required><br   />


          <input class="contact" type="text" placeholder="Your email address.." name="Customer email" required><br   />
        </div>
        <div class="formright">
          <textarea class="contact" id="question" name="enquiry" placeholder="Customer Inquiry..." style="height:100px"></textarea><br   />
          <button type="button" onclick="alert('Inquiry Submitted!')">submit</button>
          <div class="socialmed">
            <a href="https://www.facebook.com/"><img alt="facebook" title="Facebook" src="facebook.png" class="sm" width="50px"/></a>
            <a href="https://www.instagram.com/?hl=en"><img alt="instagram" title="Instagram" src="instagram.png" class="sm" width="55px"/></a>
            <a href="https://www.google.com/gmail/about/"><img alt="gmail" title="Gmail" src="gmail.png" class="sm" width="50px"/></a>

          </div>

</div>

    </div>

  </div>

</div>
</body>


</html>
