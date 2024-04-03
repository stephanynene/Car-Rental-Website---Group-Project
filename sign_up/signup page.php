<?php

include("connection.php");

if (isset($_POST['submit']))
{

  $employee_detail_firstname = $_POST['fname'];
  $employee_detail_lastname = $_POST['lname'];
  $employee_detail_username = $_POST['Username'];
  $employee_detail_password = $_POST['Password'];

      // Check if any of the fields are empty
  if (empty($employee_detail_firstname) || empty($employee_detail_lastname) || empty($employee_detail_username) || empty($employee_detail_password)) {
    echo "Please fill out all fields.";
  } else {
    // Check if username already exists
    $sql = "SELECT * FROM employee_details WHERE employee_detail_username='$employee_detail_username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<p><font color=white>Username already exists. Please choose a different username.</p>";
    } else {
      // Insert employee details into the database
      $sql = "INSERT INTO employee_details (employee_detail_firstname, employee_detail_lastname, employee_detail_username, employee_detail_password) VALUES ('$employee_detail_firstname', '$employee_detail_lastname', '$employee_detail_username', '$employee_detail_password')";
      if ($conn->query($sql) === TRUE) {
        // Redirect to the login page after successful sign up
        header("Location:login page.php");
        exit();
      } else {
        echo "ERROR!!" . $sql . "<br>" . $conn->error;
      }
    }
  }
}

  //close the connection
  $conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="signup page.css">
    </head>

	<body>
      <!-- Company Name-->
      <h2 id="form-heading">Welcome to Elite Cruisers</h2>

      <!-- Sign Up form-->
      <div class="layout">
        <section class="form-rows">
            <form method="POST" action="signup page.php"> 
              <h2 class="form-title">Sign Up</h2>

            <!-- Staff First Name-->
              <div class="staff-name">
		                <label for="fname">First name:</label><br/>
		               <input class="contact" type="text" id="fname" name="fname" placeholder="Enter your name.." required><br/>
              </div>

            <!--Staff Last Name-->
              <div class="staff-lname">   
              <label for="lname">Last name:</label><br/>
		              <input class="contact" type="text" id="lname" name="lname" placeholder="Enter your last name.." required><br/>
              </div>
              
              <!--Staff Username-->
              <div class="staff-username">
                <label for="username">Username:</label><br/>
              </div>
              <div class="type_username">
                <input class="contact" type="text" id="username" name="Username" placeholder="Enter your username.." required>
              </div>

              <!--Staff Password-->
              <div class="staff-password">
                <label for="password">Password:</label><br/>
              </div>
              <div class="type_password">  
                <input class="contact" type="password" id="password" name="Password" placeholder="Enter your password.." required>
              </div>

              <!--Submit button-->
		          <button class="submit" name="submit" type="submit" onclick="myFunction()">Submit</button>

                <li><a href="login page.php">Already have an account?</a></li>

          
	          </form>
		    </section>
      </div>
  </body>
</html>
