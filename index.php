<?php
$con = mysqli_connect("localhost", "root", "", "hub" ); #host, username, pw, db name

if(mysqli_connect_errno()) #error warning
{
  echo "Failed to connect: " . mysqli_connect_errno();
}
#using con insert the val 1 and Johntae
$query = mysqli_query($con, "INSERT INTO test VALUES ('1', 'Johntae')");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> ProHub | Social network </title>
  </head>
  <body>
    Johntae
  </body>
</html>
