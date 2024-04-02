<?php

  session_start();

  include("connection.php");

  //to reset the variables before creating a new error message
  $error= "";

  if(isset($_POST['login']))
  {
    $username=$_POST['Username'];
    $password=$_POST['Password'];

    if(empty($username))
    {
      $error="Please enter your username";
    }
    else if(empty($password))
    {
      $error="Please enter your password";
    }
    else
    {
      //to check if the username and password matched with the ones in the database
      $sql="SELECT * FROM employee_details WHERE employee_detail_username='$username' AND employee_detail_password='$password'";
      $result=mysqli_query($conn,$sql);

      if(mysqli_num_rows($result)==1)
      {
        $row=mysqli_fetch_assoc($result);
        $_SESSION['employee_detail_username']=$row['employee_detail_username'];
        $_SESSION['employee_detail_password']=$row['employee_detail_password'];
        header("Location:HOMEPAGE.php");
        exit();
      }
      else
      {
        // display the error message
        $error="Invalid username or password";
      }
    }
    //close connection
    mysqli_close($conn);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="login page.css">
  </head>
  <body>

    <!--Navigation Bar-->
    <div class="navigationbar">
      <a class="active" href="signup page.php">Sign Up</a>
    </div>

    <!--Background pic-->
    <div class="background"></div>

    <!--Company Name-->
    <h2 class="heading">Elite Cruisers</h2>
    <hr>
    <h1 class="title">Welcome Back!</h1>

    <!-- To display an error message-->
    <?php
      if(!empty($error))
          {
            ?>
            <div class ="error-message">
              <?php echo $error; ?>
            </div>
    <?php
          }
            ?>

      <form method="POST" action="login page.php">
        
      <!--Staff Username-->
      <div class="row">
        <div class="label">
          <label for="name">Username:</label></br>
        </div>
        <div class="fields">
          <input class="contact" type="text" id="name" name="Username" placeholder="Enter your name..." required>
        </div>
      </div>

    <!--Staff Password-->
    <div class="row">
      <div class="label">
        <label for="password">Password:</label></br>
      </div>
      <div class="fields">
        <input class="contact" type="password" id="password" name="Password" placeholder="Enter your password..." required>
      </div>
    </div>

    <!--link to login page-->
    <p>
      <a href="signup page.php">Don't have an account?</a>
    </p>

    <!--Login button-->
    <button class="login" type="submit" name="login">Login</button>
    <br>

    <!-- Cancel button-->
    <input type="reset" value="Cancel">

    </form>
  </body>
</html>