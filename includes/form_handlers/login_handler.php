<?php

if(isset($_POST['login_button'])) { #isset — Determine if a variable is set and is not NULL

  $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); #filter_var — Filters a variable with a specified filter. FILTER_SANITIZE_EMAIL - removes all illegal characters from an email address

  $_SESSION['log_email'] = $email; #storing email into session variable
  $password = md5($_POST['log_password']); #Get password. before we check we are going to md5 it

  $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'"); #seeing if there is an email and password match
  $check_login_query = mysqli_num_rows[$check_database_query]; #return the number of results made, 1 or 0

  if($check_login_query == 1) { #login was successful
    $row = mysqli_fetch_array($check_database_query); #getting the results of the query
    $username = $row['username']; #accessing it

    $_SESSION['username'] = $username; #creating a new session variable called username and set it to the value of username. If NULL then the user is not logged in
    header["Location: index.php"] #redirects the page to index.php. Executed if logged in
    exit();
  }
}

 ?>
