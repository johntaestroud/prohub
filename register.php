<?php
require 'config/config.php'; #identical to include except upon failure it will also produce a fatal E_COMPILE_ERROR level error
require 'includes/form_handlers/register_handler.php';
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to ProHub</title>
  </head>
  <body>

    <form action="register.php" method="post">
       <input type="email" name="log_email" placeholder="Email Address" >
       <br>
       <input type="password" name="log_password" placeholder="Password" >
       <br>
       <input type="submit" name="login_button" value="Login">
    </form>

    <!--send below info to register.php-->
    <form action="register.php" method="post"> <!---->
      <input type="text" name="reg_fname" placeholder="First Name" value="<?php
      if(isset($_SESSION['reg_fname'])) { #saving the input value
          echo $_SESSION['reg_fname'];
      }
      ?>" required>
      <br>
      <?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>

      <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
      if(isset($_SESSION['reg_lname'])) { #saving the input value
          echo $_SESSION['reg_lname'];
      }
      ?>" required>
      <br>
      <?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>

      <input type="email" name="reg_email" placeholder="Email" value="<?php
      if(isset($_SESSION['reg_email'])) { #saving the input value
          echo $_SESSION['reg_email'];
      }
      ?>" required>
      <br>

      <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
      if(isset($_SESSION['reg_email2'])) { #saving the input value
          echo $_SESSION['reg_email2'];
      }
      ?>" required>
      <br>

      <!-- in_array - checks if a value exists in an array. If the needle is in the haystack -->
      <?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
       else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
       else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>

      <input type="password" name="reg_password" placeholder="Password" required>
      <br>
      <input type="password" name="reg_password2" placeholder="Confirm Password" required>
      <br>

      <!-- in_array - checks if a value exists in an array. If the needle is in the haystack -->
      <?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>";
       else if(in_array("Your password can only contain characters or numbers<br", $error_array)) echo "Your password can only contain characters or numbers<br";
       else if(in_array("Your password must be between 5 and 30 characters<br>>", $error_array)) echo "Your password must be between 5 and 30 characters<br>"; ?>

      <input type="submit" name="register_button" value="Register">

    </form>
  </body>
</html>
