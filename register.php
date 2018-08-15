<?php
$con = mysqli_connect("localhost", "root", "", "hub" ); #host, username, pw, db name

if(mysqli_connect_errno()) #error warning
{
  echo "Failed to connect: " . mysqli_connect_errno();
}
#using con insert the val 1 and Johntae
$query = mysqli_query($con, "INSERT INTO test VALUES ('1', 'Johntae')");

#Declaring variables to prevent errors
$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = ""; #holds error msgs

if(isset($_POST['register_button'])){ #isset - determines if a var is set and is not a null

  #Registration form values
  #strip_tags - security measures
  $fname = strip_tags($_POST['reg_fname']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form
  $fname = str_replace(' ', '', $fname); #str_replace -remove spaces. Take fname var and where there is a space replace it
  $fname = ucfirst(strtolower($fname)); # strtolower - converts all the letters to lowercase, ucfirst is going to capitalize the first letter

  #last name
  $lname = strip_tags($_POST['reg_lname']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form
  $lname = str_replace(' ', '', $lname); #str_replace -remove spaces. Take fname var and where there is a space replace it
  $lname = ucfirst(strtolower($lname)); # strtolower - converts all the letters to lowercase, ucfirst is going to capitalize the first letter

  #email
  $em = strip_tags($_POST['reg_email']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form
  $em = str_replace(' ', '', $em); #str_replace -remove spaces. Take fname var and where there is a space replace it
  $em = ucfirst(strtolower($em)); # strtolower - converts all the letters to lowercase, ucfirst is going to capitalize the first letter

  #email 2
  $em2 = strip_tags($_POST['reg_email2']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form
  $em2 = str_replace(' ', '', $em2); #str_replace -remove spaces. Take fname var and where there is a space replace it
  $em2 = ucfirst(strtolower($em2)); # strtolower - converts all the letters to lowercase, ucfirst is going to capitalize the first letter

  #password
  $password = strip_tags($_POST['reg_password']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form
  $password2 = strip_tags($_POST['reg_password2']); #strip_tags - remove html tags. Store in $fname the val that was sent from the form

  $date = date("Y-m-d"); #current date
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to ProHub</title>
  </head>
  <body>

    <form action="register.php"> <!--send below info to register.php-->
      <input type="text" name="reg_fname" placeholder="First Name" required>
      <br>
      <input type="text" name="reg_lname" placeholder="Last Name" required>
      <br>
      <input type="email" name="reg_email" placeholder="Email" required>
      <br>
      <input type="email" name="reg_email2" placeholder="Confirm Email" required>
      <br>
      <input type="password" name="reg_password" placeholder="Email" required>
      <br>
      <input type="password" name="reg_password2" placeholder="Confirm Password" required>
      <br>
      <input type="submit" name="reg_button" value="Register">

    </form>
  </body>
</html>
