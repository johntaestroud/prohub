<?php

#Declaring variables to prevent errors
$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = ""; #sign_up date
$error_array = array(); #array() - Declaring into an empty array. Holds error msgs

#$_POST - used to collect values from a form with method="post"
if(isset($_POST['register_button'])){ #isset - determines if a var is set and is not a null

  #Registration form values
  #strip_tags - security measures
  $fname = strip_tags($_POST['reg_fname']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form
  $fname = str_replace(' ', '', $fname); #str_replace -remove spaces. Take fname var and where there is a space replace it
  $fname = ucfirst(strtolower($fname)); # strtolower - converts all the letters to lowercase, ucfirst is going to capitalize the first letter
  $_SESSION['reg_fname'] = $fname; # stores first name into session variable

  #last name
  $lname = strip_tags($_POST['reg_lname']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form
  $lname = str_replace(' ', '', $lname); #str_replace -remove spaces. Take fname var and where there is a space replace it
  $lname = ucfirst(strtolower($lname)); # strtolower - converts all the letters to lowercase, ucfirst is going to capitalize the first letter
  $_SESSION['reg_lname'] = $lname; # stores first name into session variable

  #email
  $em = strip_tags($_POST['reg_email']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form
  $em = str_replace(' ', '', $em); #str_replace -remove spaces. Take fname var and where there is a space replace it
  $em = ucfirst(strtolower($em)); # strtolower - converts all the letters to lowercase, ucfirst is going to capitalize the first letter
  $_SESSION['reg_email'] = $em; # stores first name into session variable

  #email 2
  $em2 = strip_tags($_POST['reg_email2']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form
  $em2 = str_replace(' ', '', $em2); #str_replace -remove spaces. Take fname var and where there is a space replace it
  $em2 = ucfirst(strtolower($em2)); # strtolower - converts all the letters to lowercase, ucfirst is going to capitalize the first letter
  $_SESSION['reg_email2'] = $em2; # stores first name into session variable

  #password
  $password = strip_tags($_POST['reg_password']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form
  $password2 = strip_tags($_POST['reg_password2']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form

  $date = date("Y-m-d"); #current date

  if($em == $em2) { #check for equality
      #filter_var - Filters a variable with a specified filter. Check if email is in valid format
      if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
          #check if em equals the validated version of the email
          $em = filter_var($em, FILTER_VALIDATE_EMAIL);

          #Check if email already exist
          $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

          #mysqli_num_rows - returns the number of rows in a result set. Count the number of rows return
          $num_rows = mysqli_num_rows($e_check);
          #array_push - Push one or more elements onto the end of array. When an err occurs it gets push into the array
          if($num_rows > 0) {
            array_push($error_array, "Email already in use<br>");
          }

        }
        else {
           array_push($error_array, "Invalid email format<br>");
        }

      }
      else {
        // echo "Emails don't match<br>";
        array_push($error_array, "Emails don't match<br>");
      }

      if(strlen($fname) > 25 || strlen($fname) < 2) {
        array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
      }

      if(strlen($lname) > 25 || strlen($lname) < 2) {
        array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
      }

      if($password != $password2) {
        array_push($error_array, "Your passwords do not match<br>");
      }
      else {
        #preg_match - Performs a regular expression match, checking to see if val only contains characters and numbers
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
          array_push($error_array, "Your password can only contain characters or numbers<br>");
        }
      }
      #strlen - Getting string length
      if(strlen($password > 30 || strlen($password) < 5)) {
        array_push($error_array, "Your password must be between 5 and 30 characters<br>");
      }

      if(empty($error_array)) { #means no errors
        $password = md5($password); #md5 - encrypts password to a long string

        #Generate username by concatenating first name and last name
        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        #create a username, if found, add the val of i (username_1)
        $i = 0;
        #if username exists add number to username
        while(mysqli_num_rows($check_username_query) != 0) {
          $i++;
          $username = $username . "_" . $i; #add the val of i (username_1)
          $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        #Profile pic
        $rand = rand(1, 2); #creating a random number between 1 and 2

        if($rand == 1)
          $profile_pic = "assets/images/profile_pics/defaults/head_amethyst.png";
        else if($rand == 2)
          $profile_pic = "assets/images/profile_pics/defaults/head_belize_hole.png";

        #$query = mysqli_query($con, "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$username', '$em', ''$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
        $query = mysqli_query($con, "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

        array_push($error_array, "<span style='color: #2ECC40;'>Registration Successful!</span><br>");

    		//Clear session variables
    		$_SESSION['reg_fname'] = "";
    		$_SESSION['reg_lname'] = "";
    		$_SESSION['reg_email'] = "";
    		$_SESSION['reg_email2'] = "";

      }

}

?>
